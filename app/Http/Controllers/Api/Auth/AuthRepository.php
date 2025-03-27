<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Api\Auth\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login($data)
    {
        try {
            return  DB::transaction(function () use ($data) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    Auth::user()->tokens()->delete();
                    $user = Auth::user();
                    return [
                        'user' => [
                            'id' => $user->id,
                            // 'emp_id' => $user->emp_id ?? null,
                            // 'first_name' => $user->first_name ?? null,
                            // 'middle_name' => $user->middle_name ?? null,
                            // 'last_name' => $user->last_name ?? null,
                            'email' => $user->email ?? null,
                            'name' => $user->email ?? null,
                        ],
                        'roles' => $user->getRoleNames(),
                        'permission' => Cache::rememberForever('user-perm-' . $user->id, fn() =>  $user->getAllPermissions()->pluck('name')),
                        'token' => $user->createToken('bonjourdeguzman')->plainTextToken,
                    ];
                }
                return 'Wrong Username or Password';
            });
        } catch (\Throwable $th) {
            return "Error: " . $th->getMessage();
        }
    }

    public function logout()
    {
        try {
            return  DB::transaction(function () {
                Auth::user()->tokens()->delete();
                return 'Your Successfully logged out';
            });
        } catch (\Throwable $th) {
            return "Error: " . $th->getMessage();
        }
    }
}
