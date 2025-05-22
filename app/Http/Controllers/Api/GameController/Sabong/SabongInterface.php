<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepositoryInterface;

interface SabongInterface
{
    public function sabongConsole(string $id): array;
    public function nextRound(array $data): array;
    public function openRound(array $data): array;
    public function closeRound(array $data): array;
    public function declareRound(array $data): array;
    public function cancelRound(array $data): array;
    public function lockRound(array $data): array;
    public function selectRound(array $data): array;
    public function resetRound(array $data): array;
    public function betRound(array $data): array;
}
