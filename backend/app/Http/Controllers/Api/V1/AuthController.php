<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Requests\Dashboard\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(private AuthService $authService) {}

    // POST /auth/signup
    public function signup(SignupRequest $request)
    {
        $user = $this->authService->signup($request->all());

        return $this->successResponse(
            new UserResource($user),
            'User registered successfully',
            201
        );
    }

    // POST /auth/login
    public function login(LoginRequest $request)
    {
        $credentials = $request->all();
        $data = $this->authService->login($credentials);

        return $this->successResponse(
            $data,
            'Login successful'
        );
    }

    // POST /auth/logout
    public function logout(Request $request)
    {
        $message = $this->authService->logout($request);

        return $this->successResponse(
            null,
            $message
        );
    }

    // POST /auth/logout-all
    public function logoutAll(Request $request)
    {
        $message = $this->authService->logoutAll($request->user());

        return $this->successResponse(
            null,
            $message
        );
    }

    // POST /auth/forgot-password
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->all();
        $message = $this->authService->forgotPassword($data['email']);

        return $this->successResponse(
            null,
            $message
        );
    }

    // POST /auth/reset-password
    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->all();
        $message = $this->authService->resetPassword($data);

        return $this->successResponse(
            null,
            $message
        );
    }

    // POST /auth/change-password
    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->all();

        $message = $this->authService->changePassword(
            $request->user(),
            $data['current_password'],
            $data['new_password']
        );

        return $this->successResponse(
            null,
            $message
        );
    }

    // GET /auth/me
    public function me(Request $request)
    {
        return $this->successResponse(
            new UserResource($request->user()),
            'Profile retrieved successfully'
        );
    }

    // PUT /auth/me
    public function updateProfile(UpdateRequest $request)
    {
        $user = $this->authService->updateProfile($request->user(), $request->all());

        return $this->successResponse(
            new UserResource($user),
            'Profile updated successfully'
        );
    }
}
