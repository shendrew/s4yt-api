<?php

namespace App\Http\Controllers\Api;

use App\Models\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Method registers new player
     * @param RegisterRequest $request
     * @param PlayerService $playerService
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, PlayerService $playerService): JsonResponse
    {
        $validated = $request->validated();
        $player = $playerService->addPlayer($validated, Configuration::getValueByKey(Configuration::REGISTER_COINS));

        Log::info('Player {$player->name} registered successfully.', ['id' => $player->id, 'email' => $player->email]);

        return $this->sendResponse(
            [
                'uuid' => $player->user->id,
                'email' => $player->user->email
            ],
            "Player registered successfully",
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user= User::where('id', $validated['id'])->first();

        if(!$user) {
            return $this->sendError('Player not registered', [], Response::HTTP_NOT_FOUND);
        }

        if(!auth()->attempt(['id' => $validated['id'], 'password' => $validated['password']])) {
            return $this->sendError('Credentials not valid', [], Response::HTTP_UNAUTHORIZED);
        }

        $token = auth()->user->createToken(env('APP_NAME'))->accessToken;

        return $this->sendResponse(
            [
                'auth' => 'Bearer',
                'token' => $token,
            ],
            "Player logged in successfully"
        );
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse(
            null,
            "Player logged out successfully"
        );
    }
}
