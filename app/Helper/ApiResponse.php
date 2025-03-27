<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller as Controller;


class ApiResponse
{
    public static function success($result, $message): JsonResponse
    {
        $response = [
            'response_id' => Carbon::now()->format('YmdHis'),
            'response_date' => Carbon::now()->setTimezone('Asia/Manila')->format('l jS F Y g:i a'),
            'response_result' => '0001',
            'response_description' => 'SUCCESS',
            'response_data' => $result, //ApiEncResponse::encrypt($result)
            'response_message' => $message
        ];
        return response()->json($response, 200);
    }

    public static function failed($error, $errorMessage, $code = 404): JsonResponse
    {
        $response = [
            'response_id' => Carbon::now()->format('YmdHis'),
            'response_date' => Carbon::now()->setTimezone('Asia/Manila')->format('l jS F Y g:i a'),
            'response_result' => '0002',
            'response_description' => 'FAILED',
            'response_data' => $errorMessage ?? null, //ApiEncResponse::encrypt($errorMessage ?? null)
            'response_message' => $error
        ];
        return response()->json($response, $code);
    }
}
