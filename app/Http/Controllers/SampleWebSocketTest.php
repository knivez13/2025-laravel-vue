<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\TestWebSocket;

class SampleWebSocketTest extends Controller
{
    public function test()
    {
        event(new TestWebSocket(Carbon::now()->setTimezone('Asia/Manila')->format('l, jS F Y, g:i A')));
        return "sadasda";
    }
}
