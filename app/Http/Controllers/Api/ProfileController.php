<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function updateInfo(UpdateProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::find(auth()->user()->id);

        $user->name = $validated['name'];
        $user->player->education_id = $validated['education_id'];
        $user->player->grade_id = $validated['grade_id'];
        $user->player->school = $validated['school'];
        $user->player->country = $validated['country'];
        $user->player->state = $validated['state'];
        $user->player->city_id = $validated['city_id'];
        $user->save();

        return $this->sendResponse(
            [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ],
            "User information updated successfully",
            200
        );
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::find(auth()->user()-id);

        $user->password = Hash::make($validated['new_password']);
        $user->save();

        return $this->sendResponse(
            [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email
            ],
            "User password updated successfully",
            200
        );
    }

    public function getReferral()
    {
        $user = auth()->user();

        $referred_by = $user->referred_by;
        $referral_code = $user->referral_code;

        return view('profile.referral', ['referred_by' => $referred_by, 'referral_code' => $referral_code]);
    }
}
