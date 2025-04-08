<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can_user_register', function () {
    $response = $this->post('/api/register', [
        'name' => 'test',
        'email' => 'test@test.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ], [
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(201);
    $response->assertJsonStructure([
        'message',
        'user',
    ]);
});

it('can_user_login', function () {
    $user = User::factory()->create();
    $response = $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ], [
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(200);
    $response->assertJsonStructure([
        'message',
        'user',
        'token',
    ]);
});

it('can_user_logout', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $response = $this->post('/api/logout', [], [
        'Authorization' => 'Bearer ' . $token,
        'Accept' => 'application/json',
    ]);

    $response->assertStatus(200);
});

it('can_user_view_profile', function () {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $response = $this->get('/api/me', [
        'Accept' => 'application/json',
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertStatus(200);
});
