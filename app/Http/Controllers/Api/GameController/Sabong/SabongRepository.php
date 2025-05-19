<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\GameModerator\GameList;
use App\Models\GameModerator\GameRoundBet;
use App\Models\GameModerator\GameListRound;
use App\Models\Maintenance\GamePresentOption;

class SabongRepository implements SabongInterface
{

    public function sabongConsole(string $id): array
    {
        return DB::transaction(function () use ($id) {
            $game = GameList::find($id);
            $res['option'] = GamePresentOption::where('game_present_id', $game['game_present_id'])->orderBy('order_list', 'asc')->get();
            $res['round'] = GameListRound::where('game_list_id', $id)->orderBy('round_no', 'asc')->get();
            $res['bet'] = GameRoundBet::where('game_list_id', $id)->where('game_round_id', $game['current_round_id'])->get();
            return $res;
        });
    }

    public function nextRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
    public function openRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
    public function closeRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
    public function declareRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
    public function cancelRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }

    public function lockRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }

    public function selectRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }

    public function resetRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
}
