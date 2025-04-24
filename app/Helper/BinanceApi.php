<?php

namespace App\Helper;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class BinanceApi
{
    private function getSignatureQuery(): array
    {
        $timestamp = round(microtime(true) * 1000);
        $query = http_build_query(['timestamp' => $timestamp]);
        $signature = hash_hmac('sha256', $query, Auth::user()->secretKey);

        return ['query' => $query, 'signature' => $signature];
    }

    public static function makeRequest(string $url): \Illuminate\Http\Client\Response
    {
        ['query' => $query, 'signature' => $signature] = (new self())->getSignatureQuery();

        return Http::withHeaders([
            'X-MBX-APIKEY' => Auth::user()->apiKey
        ])->get("{$url}?{$query}&signature={$signature}");
    }

    public static function getDepositHistory()
    {
        return self::makeRequest("https://api.binance.com/sapi/v1/capital/deposit/hisrec")->json();
    }

    public static function getWithdrawHistory()
    {
        return self::makeRequest("https://api.binance.com/sapi/v1/capital/withdraw/history")->json();
    }

    public static function getTotalSpotBalanceInUSDT(): array
    {
        $accountResponse = self::makeRequest("https://api.binance.com/api/v3/account");

        if ($accountResponse->failed()) {
            throw new \Exception('Failed to fetch account info');
        }

        $balances = collect($accountResponse->json()['balances']);
        $prices = self::getPrices();

        $total = 0;
        $data = [];

        foreach ($balances as $balance) {
            $asset = $balance['asset'];
            $free = (float)$balance['free'];

            if ($free == 0) continue;

            if ($asset === 'USDT') {
                $total += $free;
                continue;
            }

            $symbol = $asset . 'USDT';
            if ($prices->has($symbol)) {
                $value = $free * (float)$prices[$symbol]['price'];
                $total += $value;
                $data['spot'][$asset] = ["count" => $free, "price" => $value];
            }
        }

        $data['total'] = round($total, 2);
        return $data;
    }

    public static function getEarnBalancesInUSDT(): array
    {
        $flexible = self::makeRequest("https://api.binance.com/sapi/v1/simple-earn/flexible/position")->json();
        $locked = self::makeRequest("https://api.binance.com/sapi/v1/simple-earn/locked/position")->json();

        $flexibleRows = is_array($flexible['rows'] ?? null) ? $flexible['rows'] : [];
        $lockedRows = is_array($locked['rows'] ?? null) ? $locked['rows'] : [];

        $prices = self::getPrices();
        $total = 0;
        $data = [];

        foreach (array_merge($flexibleRows, $lockedRows) as $position) {
            if (!is_array($position) || !isset($position['asset'])) continue;

            $asset = $position['asset'];
            $amount = (float)($position['totalAmount'] ?? $position['amount'] ?? 0);
            $symbol = $asset . 'USDT';

            if ($amount > 0 && $prices->has($symbol)) {
                $value = $amount * (float)$prices[$symbol]['price'];
                $total += $value;
                $data['earn'][$asset] = ["count" => $amount, "price" => $value];
            }
        }

        $data['total'] = round($total, 2);
        return $data;
    }

    public static function getPrices(): Collection
    {
        $response = Http::get("https://api.binance.com/api/v3/ticker/price");
        return collect($response->json())->keyBy('symbol');
    }

    public static function getEarnInterestTransactions()
    {
        $flexible = self::makeRequest("https://api.binance.com/sapi/v1/simple-earn/flexible/history/interest")->json();
        $locked = self::makeRequest("https://api.binance.com/sapi/v1/simple-earn/locked/history/rewards")->json();

        $flexible = is_array($flexible ?? null) ? $flexible : [];
        $locked = is_array($locked ?? null) ? $locked : [];

        return [
            'flexible_interest' => $flexible,
            'locked_rewards' => $locked
        ];
    }
}
