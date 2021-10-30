<?php

namespace App\Services;


class AuthService
{
    public function login(array $credentials)
    {
        return auth('admin')->attempt($credentials);
    }
}
