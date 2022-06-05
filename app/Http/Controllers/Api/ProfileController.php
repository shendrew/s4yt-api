<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function updateInfo(UpdateProfileRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::find(Auth::user()->id);

        $user->name = $validated['name'];
        $user->education_id = $validated['education_id'];
        $user->grade_id = $validated['grade_id'];
        $user->school = $validated['school'];
        $user->save();

        return $this->sendResponse(
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            "User information updated successfully",
            200
        );
    }

    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::find(Auth::user()->id);

        $user->password = $validated['new_password'];
        $user->save();

        return $this->sendResponse(
            [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email
            ],
            "User password updated successfully",
            200
        );
    }
}
