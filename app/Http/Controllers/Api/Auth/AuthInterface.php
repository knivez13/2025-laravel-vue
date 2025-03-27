<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

interface AuthInterface
{
    public function register(array $data);
    public function login(array $data);
    public function logout();
}
