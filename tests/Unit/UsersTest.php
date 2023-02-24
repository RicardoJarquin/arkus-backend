<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

beforeEach(function () {
    Artisan::call('db:seed');
});

it('can register a user', function () {
    $data = [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'english_level' => 'medium',
        'technical_skills' => 'PHP, Laravel',
        'cv_link' => 'https://example.com/cv',
        'admin' => true,
    ];

    $this->actingAs(User::find(1), 'api');

    $response = $this->postJson('/api/users/register', $data, ['Accept' => 'application/json']);

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Registration Successful',
        ]);

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'english_level' => 'medium',
        'technical_skills' => 'PHP, Laravel',
        'cv_link' => 'https://example.com/cv',
    ]);

    $user = \App\Models\User::where('email', 'test@example.com')->first();
    $this->assertTrue($user->hasRole('admin'));
});