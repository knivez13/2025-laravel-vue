<?php

namespace App\Helper;

use App\Helper\ApiResponse;
use App\Helper\ApiEncResponse;

class ApiCheckEnc
{
    public static function check($encrypt)
    {
        if (!isset($encrypt)) {
            return ApiResponse::failed('encryption error', 400);
        }
        return ApiEncResponse::decryptJson($encrypt);
    }
}
