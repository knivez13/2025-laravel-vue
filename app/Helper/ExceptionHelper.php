<?php

namespace App\Helper;

use App\Helper\ApiResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionHelper
{
    public static function handle(\Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return ApiResponse::failed('Validation Error', $e->errors(), 422);
        }

        if ($e instanceof AuthorizationException) {
            return ApiResponse::failed('Authorization Error', 'You do not have permission to perform this action.', 403);
        }

        if ($e instanceof HttpException) {
            return ApiResponse::failed('Http Error', $e->getMessage(), 420);
        }

        return ApiResponse::failed('errors', 'Something went wrong.', 500);
    }
}
