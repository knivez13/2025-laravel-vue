<?php

namespace App\Http\Controllers\Api\Auth;

interface AuthInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
}
