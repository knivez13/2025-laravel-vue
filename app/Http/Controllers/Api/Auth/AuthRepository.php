<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
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
            'username' => $data['name'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function login($data)
    {
        try {
            return  DB::transaction(function () use ($data) {
                if (Auth::attempt(['username' => $data['username'], 'password' => $data['password'], 'status' => 1])) {
                    Auth::user()->tokens()->delete();
                    $user = Auth::user();
                    User::find($user->id)->update([
                        'last_online' => Carbon::now(),
                        'ip_address' => $data['ip_address'] ?? null,
                    ]);
                    return [
                        'user' => $user,
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
