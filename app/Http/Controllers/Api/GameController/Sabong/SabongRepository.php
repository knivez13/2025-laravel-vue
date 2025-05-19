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

    // 0=idel / live
    // 1=current
    // 2=open
    // 3=closed
    // 4=declared /closed
    // 5=cancel
    // 6=lock
    // 7=reset

    public function selectRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();
            GameList::find($data['game_list_id'])
                ->update([
                    'current_round_id' => $data['game_round_id'],
                    'updated_by' => $user->id,
                ]);
            GameListRound::find($data['game_round_id'])->update([
                'status' => 1,
                'updated_by' => $user->id,
            ]);
            $res['game'] = GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id']);
            $res['round'] = GameListRound::where('game_list_id', $data['game_list_id'])->orderBy('round_no', 'asc')->get();
            return $res;
        });
    }

    public function nextRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            GameListRound::where()->where()->where()->first();
            GameList::find($data['game_list_id'])
                ->update([
                    'current_round_id' => $data['game_round_id'],
                    'updated_by' => $user->id,
                ]);
            GameListRound::find($data['game_round_id'])->update([
                'status' => 1,
                'updated_by' => $user->id,
            ]);
            $res['game'] = GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id']);
            $res['round'] = GameListRound::where('game_list_id', $data['game_list_id'])->orderBy('round_no', 'asc')->get();
            return $res;
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



    public function resetRound(array $data): bool
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();

            return true;
        });
    }
}
