<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dashboard;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->baseUrl = '/api/v1';
    $this->password = 'password123';
    $this->userData = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => $this->password,
        'password_confirmation' => $this->password,
    ];
});

it('can signup a new user', function () {
    $response = $this->postJson($this->baseUrl . '/auth/signup', $this->userData);
    $response->assertStatus(201);
});

it('can login and get token', function () {
    $this->postJson($this->baseUrl . '/auth/signup', $this->userData);
    $response = $this->postJson($this->baseUrl . '/auth/login', [
        'email' => $this->userData['email'],
        'password' => $this->password,
    ]);
    $response->assertStatus(200)->assertJsonStructure(['token']);
    $this->token = $response->json('token');
});

it('can access protected routes with token', function () {
    $this->postJson($this->baseUrl . '/auth/signup', $this->userData);
    $login = $this->postJson($this->baseUrl . '/auth/login', [
        'email' => $this->userData['email'],
        'password' => $this->password,
    ]);

    $token = $login->json('token');

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson($this->baseUrl . '/auth/me');

    $response->assertStatus(200)->assertJson(['email' => $this->userData['email']]);
});

it('can create, read, update dashboard with token', function () {
    $this->postJson($this->baseUrl . '/auth/signup', $this->userData);
    $login = $this->postJson($this->baseUrl . '/auth/login', [
        'email' => $this->userData['email'],
        'password' => $this->password,
    ]);
    $token = $login->json('token');

    $headers = ['Authorization' => "Bearer {$token}"];

    $create = $this->withHeaders($headers)->postJson($this->baseUrl . '/dashboards', [
        'title' => 'My Dashboard',
        'description' => 'Testing dashboard',
    ]);
    $create->assertStatus(201);
    $dashboardId = $create->json('id');

    $index = $this->withHeaders($headers)->getJson($this->baseUrl . '/dashboards');
    $index->assertStatus(200);

    $show = $this->withHeaders($headers)->getJson($this->baseUrl . "/dashboards/{$dashboardId}");
    $show->assertStatus(200)->assertJson(['title' => 'My Dashboard']);

    $update = $this->withHeaders($headers)->putJson($this->baseUrl . "/dashboards/{$dashboardId}", [
        'title' => 'Updated Dashboard',
    ]);
    $update->assertStatus(200)->assertJson(['title' => 'Updated Dashboard']);
});

it('can logout user', function () {
    $this->postJson($this->baseUrl . '/auth/signup', $this->userData);
    $login = $this->postJson($this->baseUrl . '/auth/login', [
        'email' => $this->userData['email'],
        'password' => $this->password,
    ]);
    $token = $login->json('token');

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson($this->baseUrl . '/auth/logout');

    $response->assertStatus(200);
});
