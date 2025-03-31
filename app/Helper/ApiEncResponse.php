<?php

namespace App\Helper;

use Illuminate\Support\Str;

class ApiEncResponse
{
    // Decrypt the data in Laravel (Backend)
    public static function encryptJson($data)
    {
        $key = Str::random(32);
        return  openssl_encrypt(json_encode($data), 'AES-256-CBC', $key, 0, substr($key, 0, 16)) . $key;
    }

    public static function decryptJson($encryptedData)
    {
        $key = substr($encryptedData, -32);
        return json_decode(openssl_decrypt(substr($encryptedData, 0, -32), 'AES-256-CBC', $key, 0, substr($key, 0, 16)), true);
    }
}
