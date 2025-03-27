<?php

namespace App\Helper;

use Illuminate\Support\Str;

class ApiEncResponse
{
    // Decrypt the data in Laravel (Backend)
    public static function encrypt($data)
    {
        $key = Str::random(32);
        $iv = Str::random(16);
        $encryptedData = openssl_encrypt(json_encode($data ?? null), 'AES-256-CBC', $key, 0, $iv);
        $chunks = str_split($encryptedData, 16);
        $result = $chunks[0] . $key . $iv . implode('', array_slice($chunks, 1));
        return base64_encode($result);
    }

    public static function decrypt($encryptedData)
    {
        $data = base64_decode($encryptedData);
        $firstChunk = substr($data, 0, 16);
        $key = substr($data, 16, 32);  // 32 characters for the key
        $iv = substr($data, 48, 16);   // 16 characters for the IV
        $remainingEncryptedData = substr($data, 64);
        $fullEncryptedData = $firstChunk . $remainingEncryptedData;
        return json_decode(openssl_decrypt($fullEncryptedData, 'AES-256-CBC', $key, 0, $iv));
    }
}
