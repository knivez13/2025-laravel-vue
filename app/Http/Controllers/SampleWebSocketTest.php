<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Events\DynamicBroadcastEvent;
use App\Events\DynamicPrivateBroadcastEvent;

class SampleWebSocketTest extends Controller
{
    public function test()
    {
        event(new DynamicBroadcastEvent(Carbon::now()->setTimezone('Asia/Manila')->format('l, jS F Y, g:i A'), 'chat'));
        return "sadasda";
    }
    public function privateTest()
    {
        event(new DynamicPrivateBroadcastEvent(Carbon::now()->setTimezone('Asia/Manila')->format('l, jS F Y, g:i A'), 'chat_private.123123abcd'));
        return "sadasda";
    }
}
