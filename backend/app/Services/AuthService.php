<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Register new user
     */
    public function signup(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Login user
     */
    public function login(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
        $token = $user->createToken('web-client')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }


    /**
     * Logout current session (revoke only current token)
     */
    public function logout($request): string
    {
        $request->user()->currentAccessToken()->delete();
        return 'Logged out successfully.';
    }

    /**
     * Logout all sessions (revoke all tokens)
     */
    public function logoutAll(User $user): string
    {
        $user->tokens()->delete();
        return 'Logged out from all devices.';
    }

    /**
     * Forgot password — send reset link
     */
    public function forgotPassword(string $email): string
    {
        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages(['email' => [__($status)]]);
        }

        return __($status);
    }

    /**
     * Reset password with token
     */
    public function resetPassword(array $data): string
    {
        $status = Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['email' => [__($status)]]);
        }

        return __($status);
    }

    /**
     * Change password for logged-in user
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): string
    {
        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password is incorrect.'],
            ]);
        }

        $user->update(['password' => Hash::make($newPassword)]);

        return 'Password changed successfully.';
    }

    /**
     * Get current user
     */
    public function me(User $user): User
    {
        return $user;
    }

    /**
     * Update user profile
     */
    public function updateProfile(User $user, array $data): User
    {
        $user->update($data);
        return $user->fresh();
    }
}
