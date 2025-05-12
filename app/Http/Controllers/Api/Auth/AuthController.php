<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helper\ApiResponse;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helper\ApiEncResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Auth\AuthInterface;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $input = Arr::only($data, ['username', 'password']);

        return ApiResponse::success($this->authRepository->register($input), 'register success');
    }

    public function login(Request $request)
    {
        $data = ApiEncResponse::decryptJson($request['encrypt']);

        $validator = Validator::make($data, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponse::failed('Validation Error.', $validator->errors(), 422);
        }
        $input = Arr::only($data, ['username', 'password']);
        $input['ip_address'] = $request->ip();
        return ApiResponse::success($this->authRepository->login($input), 'login success');
    }

    public function logout()
    {
        $this->authRepository->logout();
        return ApiResponse::success($this->authRepository->logout(), 'logout success');
    }
}
