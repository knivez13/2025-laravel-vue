<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepositoryInterface;

interface SabongInterface
{
    public function sabongConsole(string $id): array;
    public function nextRound(array $data): bool;
    public function openRound(array $data): bool;
    public function closeRound(array $data): bool;
    public function declareRound(array $data): bool;
    public function cancelRound(array $data): bool;
    public function lockRound(array $data): bool;
    public function selectRound(array $data): bool;
    public function resetRound(array $data): bool;
}
