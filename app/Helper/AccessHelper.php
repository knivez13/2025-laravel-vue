<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\Access\AuthorizationException;

class AccessHelper
{
    public static function check(string $data)
    {
        $perm = Cache::get('user-perm-' . Auth::user()->id);

        if (!$perm->contains($data)) {
            throw new AuthorizationException('You do not have permission to perform this action.', 403);
        }

        return true;
    }
}
