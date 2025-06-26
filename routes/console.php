<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Artisan::command('newuser {name} {email} {password}', function (string $name, string $email, string $password) {
    if (User::where('email', $email)->exists()) {
        $this->error("A user with email {$email} already exists.");
        return 1;
    }

    User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $this->info("User {$email} created successfully.");
})->purpose('Create a new user');