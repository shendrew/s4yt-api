<?php

namespace App\Http\Controllers\Api;

use App\Models\Configuration;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use App\Models\User;
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

        Log::info('User {$player->name} registered successfully.', ['id' => $player->id, 'email' => $player->email]);

        return $this->sendResponse(
            [
                'name' => $player->user->name,
                'email' => $player->user->email
            ],
            "User registered successfully",
            201
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user= User::where('email', $validated['email'])->first();

        if(!$user) {
            return $this->sendError('User not registered', [], 401);
        }

        if(!Hash::check($validated['password'], $user->password)) {
            return $this->sendError('Credentials not valid', [], 401);
        }

        $token = $user->createToken(env('APP_NAME'))->accessToken;

        return $this->sendResponse(
            [
                'auth' => 'Bearer',
                'token' => $token,
            ],
            "User logged in successfully"
        );
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse(
            null,
            "User logged out successfully"
        );
    }
}
