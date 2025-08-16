<?php

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->service = new AuthService();
});

/**
 * Signup
 */
it('registers a new user and returns token', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ];

    $result = $this->service->signup($data);

    expect($result['user'])->toBeInstanceOf(User::class);
    expect($result['user']->email)->toBe('test@example.com');
    expect($result['token'])->toBeString();
});

/**
 * Login
 */
it('logs in a user with valid credentials', function () {
    $user = User::factory()->create(['password' => Hash::make('secret')]);

    $result = $this->service->login([
        'email' => $user->email,
        'password' => 'secret',
    ]);

    expect($result['user']->id)->toBe($user->id);
    expect($result['token'])->toBeString();
});

it('throws validation exception for invalid login', function () {
    $this->service->login([
        'email' => 'wrong@example.com',
        'password' => 'wrong',
    ]);
})->throws(ValidationException::class);

/**
 * Logout
 */
it('logs out current session', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $request = new \Illuminate\Http\Request();
    $request->setUserResolver(fn () => $user);

    $message = $this->service->logout($request);

    expect($message)->toBe('Logged out successfully.');
});

/**
 * Logout All
 */
it('logs out from all devices', function () {
    $user = User::factory()->create();
    $user->createToken('test');
    $message = $this->service->logoutAll($user);
    expect($message)->toBe('Logged out from all devices.');
});

/**
 * Forgot Password
 */
it('sends reset link successfully', function () {
    Password::shouldReceive('sendResetLink')
        ->once()
        ->andReturn(Password::RESET_LINK_SENT);

    $message = $this->service->forgotPassword('test@example.com');

    expect($message)->toBe(__(Password::RESET_LINK_SENT));
});

it('throws exception when reset link fails', function () {
    Password::shouldReceive('sendResetLink')
        ->once()
        ->andReturn('invalid');

    $this->service->forgotPassword('test@example.com');
})->throws(ValidationException::class);

/**
 * Reset Password
 */
it('resets password successfully', function () {
    Event::fake();

    Password::shouldReceive('reset')
        ->once()
        ->andReturn(Password::PASSWORD_RESET);

    $message = $this->service->resetPassword([
        'email' => 'test@example.com',
        'token' => 'dummy',
        'password' => 'newpass',
        'password_confirmation' => 'newpass',
    ]);

    expect($message)->toBe(__(Password::PASSWORD_RESET));
});

it('throws exception on reset failure', function () {
    Password::shouldReceive('reset')
        ->once()
        ->andReturn('invalid');

    $this->service->resetPassword([
        'email' => 'test@example.com',
        'token' => 'dummy',
        'password' => 'newpass',
        'password_confirmation' => 'newpass',
    ]);
})->throws(ValidationException::class);

/**
 * Change Password
 */
it('changes password successfully', function () {
    $user = User::factory()->create(['password' => Hash::make('oldpass')]);

    $message = $this->service->changePassword($user, 'oldpass', 'newpass');

    expect($message)->toBe('Password changed successfully.');
    expect(Hash::check('newpass', $user->fresh()->password))->toBeTrue();
});

it('throws exception if current password is wrong', function () {
    $user = User::factory()->create(['password' => Hash::make('oldpass')]);

    $this->service->changePassword($user, 'wrongpass', 'newpass');
})->throws(ValidationException::class);

/**
 * Me
 */
it('returns the current user', function () {
    $user = User::factory()->create();
    $result = $this->service->me($user);
    expect($result->id)->toBe($user->id);
});

/**
 * Update Profile
 */
it('updates the user profile', function () {
    $user = User::factory()->create(['name' => 'Old']);
    $updated = $this->service->updateProfile($user, ['name' => 'New']);
    expect($updated->name)->toBe('New');
});
