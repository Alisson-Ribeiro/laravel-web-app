<?php

use App\Models\User;

test('user has fillable properties', function () {
    $user = new User();

    $expected = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    expect($user->getFillable())->toEqual($expected);
});

test('user has hidden properties', function () {
    $user = new User();

    $expected = [
        'password',
        'remember_token',
    ];

    expect($user->getHidden())->toEqual($expected);
});

test('user has casts properties', function () {
    $user = new User();

    $expected = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'id' => 'int',
    ];

    expect($user->getCasts())->toEqual($expected);
});
