<?php

use Illuminate\Support\Facades\Schema;

beforeEach(function () {
    // Rodar as migrações antes de cada teste
    $this->artisan('migrate');
});

afterEach(function () {
    // Resetar o banco de dados após cada teste
    $this->artisan('migrate:reset');
});

test('users table exists with correct columns', function () {
    expect(Schema::hasTable('users'))->toBeTrue();

    $columns = Schema::getColumnListing('users');
    expect($columns)->toContain('id', 'first_name', 'last_name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at');
});

test('password_reset_tokens table exists with correct columns', function () {
    expect(Schema::hasTable('password_reset_tokens'))->toBeTrue();

    $columns = Schema::getColumnListing('password_reset_tokens');
    expect($columns)->toContain('email', 'token', 'created_at');
});

test('sessions table exists with correct columns', function () {
    expect(Schema::hasTable('sessions'))->toBeTrue();

    $columns = Schema::getColumnListing('sessions');
    expect($columns)->toContain('id', 'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity');
});
