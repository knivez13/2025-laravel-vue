<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestWebSocket;

class SampleWebSocketTest extends Controller
{
    public function test()
    {
        event(new TestWebSocket('sample'));
        return "sadasda";
    }
}
