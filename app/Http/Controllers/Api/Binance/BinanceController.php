<?php

namespace App\Http\Controllers\Api\Binance;

use App\Helper\BinanceApi;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BinanceController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (Auth::user()->apiKey == null || Auth::user()->secretKey == null) {
                return ApiResponse::success('Binance Api Token Error', 'Insert Binance Api Key and Secret Key');
            }
            $data['spot_data'] = BinanceApi::getTotalSpotBalanceInUSDT();
            $data['earn_data'] = BinanceApi::getEarnBalancesInUSDT();
            $data['earn_trans_data'] = BinanceApi::getEarnInterestTransactions();
            $data['dep_history_data'] = BinanceApi::getDepositHistory();
            $data['with_history_data'] = BinanceApi::getWithdrawHistory();
            return ApiResponse::success($data, 'fetch success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
}
