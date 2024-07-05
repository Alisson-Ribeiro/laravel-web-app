<?php

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Notifications\TestNotification;

beforeEach(function () {
    $this->refreshApplication();
});

test('user can be created', function () {
    $user = User::factory()->create([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@example.com',
        'password' => Hash::make('password123'),
    ]);

    expect($user)->toBeInstanceOf(User::class);
    expect($user->first_name)->toBe('John');
    expect($user->last_name)->toBe('Doe');
    expect($user->email)->toBe('john.doe@example.com');
});

test('user email must be unique', function () {
    User::factory()->create([
        'email' => 'unique@example.com',
    ]);

    $validator = Validator::make(
        ['email' => 'unique@example.com'],
        ['email' => 'unique:users,email']
    );

    expect($validator->fails())->toBeTrue();
});

test('user can receive notifications', function () {
    Notification::fake();

    $user = User::factory()->create();

    $user->notify(new TestNotification());

    Notification::assertSentTo(
        [$user], TestNotification::class
    );
});
