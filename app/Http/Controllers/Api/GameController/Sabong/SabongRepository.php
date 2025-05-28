<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Events\DynamicBroadcastEvent;
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
            $res['bet'] =  GameRoundBet::select('bet_option_id', 'user_id', DB::raw('SUM(bet_amount) as bet_amount'))
                ->where('game_list_id',  $id)
                ->where('game_round_id', $game['current_round_id'])
                ->groupBy('bet_option_id')
                ->groupBy('user_id')
                ->with(['gameOption', 'userInfo'])
                ->get();
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
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);

            // Check if round is open
            if (!$game->current_round_id) {
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
            }
            $new_round = GameListRound::find($data['game_round_id']);

            if ($new_round->status == 0) {
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
            }

            $res['error'] = 'Round Already Open or Finish';
            $res['game'] = GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id']);
            $res['round'] = GameListRound::where('game_list_id', $data['game_list_id'])->orderBy('round_no', 'asc')->get();
            return $res;
        });
    }
    public function nextRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $user = Auth::user();
            $round_no = !empty($data['current_round_id']) ? GameListRound::find($data['current_round_id'])->round_no : 0;
            $res['round2'] = GameListRound::where('game_list_id', $data['game_list_id'])->where('status', 0)->where('round_no', '>=', $round_no)->orderBy('round_no', 'asc')->first();
            GameList::find($data['game_list_id'])
                ->update([
                    'current_round_id' => $res['round2']->id,
                    'updated_by' => $user->id,
                ]);
            GameListRound::find($res['round2']->id)->update([
                'status' => 1,
                'updated_by' => $user->id,
            ]);
            return $this->getGameWithRounds($data['game_list_id']);
        });
    }
    public function openRound(array $data): array
    {
        return DB::transaction(function () use ($data) {

            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);

            if ($game->current_round_id && $game->currentRound->status == 1) {
                $userID = Auth::user();
                $padding = GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id'])->padding;
                // return ['message' => $padding];
                if ($padding > 0) {
                    $user = User::findOrFail($userID->id);

                    GameRoundBet::create([
                        'user_id' => $user->id,
                        'game_list_id' => $data['game_list_id'],
                        'game_round_id' => $data['current_round_id'],
                        'bet_option_id' => GamePresentOption::where('code', 'MERON')->first()->id,
                        'bet_amount' => $padding,
                        'before_amount' => $user->balance_amount,
                        'after_amount' => $user->balance_amount - $padding,
                        'created_by' => $user->id,
                    ]);

                    GameRoundBet::create([
                        'user_id' => $user->id,
                        'game_list_id' => $data['game_list_id'],
                        'game_round_id' => $data['current_round_id'],
                        'bet_option_id' => GamePresentOption::where('code', 'WALA')->first()->id,
                        'bet_amount' => $padding,
                        'before_amount' => $user->balance_amount,
                        'after_amount' => $user->balance_amount - $padding,
                        'created_by' => $user->id,
                    ]);
                    $user->decrement('balance_amount', $padding * 2);
                }


                GameListRound::find($data['current_round_id'])
                    ->update([
                        'status' => 2,
                        'updated_by' => $userID->id,
                    ]);

                return $this->getGameWithRounds($data['game_list_id']);
            }
            return array_merge($this->getGameWithRounds($game->id), [
                'error' => 'Round Already Open or Finished',
            ]);
        });
    }
    public function closeRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);

            if ($game->current_round_id && $game->currentRound->status == 2 || $game->currentRound->status == 7) {
                $user = Auth::user();
                GameListRound::find($data['current_round_id'])
                    ->update([
                        'status' => 3,
                        'updated_by' => $user->id,
                    ]);
                return $this->getGameWithRounds($data['game_list_id']);
            }
            return array_merge($this->getGameWithRounds($game->id), [
                'error' => 'Round Open Can Close',
            ]);
        });
    }
    public function declareRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);
            if ($game->current_round_id && $game->currentRound->status == 3) {

                if (!$data['win_option_id']) {
                    return array_merge($this->getGameWithRounds($game->id), [
                        'error' => 'Need to Declare Win Option',
                    ]);
                }
                $user = Auth::user();
                GameListRound::find($data['current_round_id'])
                    ->update([
                        'status' => 4,
                        'win_option_id' => $data['win_option_id'],
                        'updated_by' => $user->id,
                    ]);
                return $this->getGameWithRounds($data['game_list_id']);
            }
            return array_merge($this->getGameWithRounds($game->id), [
                'error' => 'Round Close Can Declare',
            ]);
        });
    }
    public function cancelRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);
            if ($game->current_round_id && $game->currentRound->status == 5) {
                return array_merge($this->getGameWithRounds($game->id), [
                    'error' => 'Round Already Canceled',
                ]);
            }
            $user = Auth::user();
            GameListRound::find($data['current_round_id'])
                ->update([
                    'status' => 5,
                    'updated_by' => $user->id,
                ]);
            return $this->getGameWithRounds($data['game_list_id']);
        });
    }
    public function lockRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);
            if ($game->current_round_id && $game->currentRound->status == 4) {
                $user = Auth::user();
                GameListRound::find($data['current_round_id'])
                    ->update([
                        'status' => 6,
                        'updated_by' => $user->id,
                    ]);
                return $this->getGameWithRounds($data['game_list_id']);
            }
            return array_merge($this->getGameWithRounds($game->id), [
                'error' => 'You Need Declare First',
            ]);
        });
    }
    public function resetRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);
            if ($game->current_round_id && $game->currentRound->status == 7 || $game->currentRound->status == 5) {
                return array_merge($this->getGameWithRounds($game->id), [
                    'error' => 'You Cannot Reset Round',
                ]);
            }
            $user = Auth::user();
            GameList::find($data['game_list_id'])
                ->update([
                    'current_round_id' => $data['game_round_id'],
                    'updated_by' => $user->id,
                ]);
            GameListRound::find($data['game_round_id'])
                ->update([
                    'status' => 7,
                    'win_option_id' => null,
                    'updated_by' => $user->id,
                ]);
            return $this->getGameWithRounds($data['game_list_id']);
        });
    }

    public function betRound(array $data): array
    {
        return DB::transaction(function () use ($data) {
            $userId = Auth::id();
            $user = User::findOrFail($userId);
            $game = GameList::with(['gamePresent', 'currentRound'])->findOrFail($data['game_list_id']);

            if ($game->current_round_id && $game->currentRound->status !== 2) {
                return ['error' => 'Round Not Open'];
            }

            $minBet = $user->min_bet_time ?: $game->gamePresent->min_bet;
            $maxBet = $user->max_bet_time ?: $game->gamePresent->max_bet;
            $maxBetGame = $user->max_bet_game ?: $game->gamePresent->max_total_bet;

            $roundSum = GameRoundBet::where('user_id', $userId)
                ->where('game_list_id', $data['game_list_id'])
                ->where('game_round_id', $data['current_round_id'])
                ->sum('bet_amount');

            $totalMaxBet = $roundSum + $data['bet_amount'];

            if ($data['bet_amount'] > $user->balance_amount) {
                return ['error' => 'Your Bet Amount is more than your balance'];
            }

            if ($data['bet_amount'] < $minBet) {
                return ['error' => 'Your Bet Amount is below the minimum bet'];
            }

            if ($data['bet_amount'] > $maxBet) {
                return ['error' => 'Your Bet Amount is above the maximum bet'];
            }

            if ($totalMaxBet > $maxBetGame) {
                return ['error' => 'You reached the maximum total bet amount'];
            }

            $betsData = $this->getBetSummary($data['game_list_id'], $data['current_round_id']);
            extract($this->calculateOdds($betsData, $game->rate));

            // Create Bet
            $bet = GameRoundBet::create([
                'user_id' => $userId,
                'game_list_id' => $data['game_list_id'],
                'game_round_id' => $data['current_round_id'],
                'bet_option_id' => $data['bet_option_id'],
                'bet_amount' => $data['bet_amount'],
                'before_amount' => $user->balance_amount,
                'after_amount' => $user->balance_amount - $data['bet_amount'],
                'ods_meron' => $final_meron_ods,
                'ods_wala' => $final_wala_ods,
                'created_by' => $userId,
            ]);

            $user->decrement('balance_amount', $data['bet_amount']);



            // Fetch Updated Bets and Calculate Odds
            $betsData = $this->getBetSummary($data['game_list_id'], $data['current_round_id']);
            extract($this->calculateOdds($betsData, $game->rate));

            GameListRound::find($data['current_round_id'])->update([
                'ods_meron' => $ods_meron,
                'ods_wala' => $ods_wala,
                'total_meron' => $total_meron,
                'total_wala' => $total_wala,
                'total_draw' => $total_draw,
                'multiplier' => $game->multiplier,
            ]);

            broadcast(new DynamicBroadcastEvent(GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id']), 'game.' . $data['game_list_id']));


            return [
                'game' => GameList::with(['gamePresent', 'currentRound'])->find($data['game_list_id']),
                'user' => $user->fresh(),
                // 'bet' => $betsData['bets'],
                // 'total_meron' => $total_meron,
                // 'total_wala' => $total_wala,
                // 'total_draw' => $total_draw,
                // 'multiplier' => $game->multiplier,
                // 'rate' => $rate,
                // 'ods_meron' => $ods_meron,
                // 'ods_wala' => $ods_wala,
                // 'pay_meron' => $final_meron_ods * 100,
                // 'pay_wala' => $final_wala_ods * 100,
            ];
        });
    }

    private function getGameWithRounds($gameListId): array
    {
        return DB::transaction(function () use ($gameListId) {
            broadcast(new DynamicBroadcastEvent(GameList::with(['gamePresent', 'currentRound'])->find($gameListId), 'game.' . $gameListId));

            return [
                'game' => GameList::with(['gamePresent', 'currentRound'])->find($gameListId),
                'round' => GameListRound::where('game_list_id', $gameListId)->orderBy('round_no', 'asc')->get(),
            ];
        });
    }

    private function getBetSummary($gameListId, $roundId): array
    {
        $bets = GameRoundBet::select('bet_option_id', DB::raw('SUM(bet_amount) as total'))
            ->where('game_list_id', $gameListId)
            ->where('game_round_id', $roundId)
            ->groupBy('bet_option_id')
            ->with('gameOption')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->bet_option_id,
                    'total' => $item->total,
                    'option_name' => $item->gameOption->code ?? null,
                ];
            })->values()->all();

        return ['bets' => $bets];
    }

    private function calculateOdds(array $betsData, $gameRate): array
    {
        $totals = ['MERON' => 0, 'WALA' => 0, 'DRAW' => 0];

        foreach ($betsData['bets'] as $bet) {
            if (isset($totals[$bet['option_name']])) {
                $totals[$bet['option_name']] = $bet['total'];
            }
        }

        $rate = (100 - $gameRate) / 100;
        $total_meron = $totals['MERON'];
        $total_wala = $totals['WALA'];
        $total_draw = $totals['DRAW'];

        $ods_meron = $total_meron ? (($total_wala + $total_meron * $rate) / $total_meron) : 0.00;
        $ods_wala = $total_wala ? (($total_wala + $total_meron * $rate) / $total_wala) : 0.00;

        $final_meron_ods = max(1.6, min($ods_meron, 2.1));
        $final_wala_ods = max(1.6, min($ods_wala, 2.1));

        return compact('total_meron', 'total_wala', 'total_draw', 'rate', 'ods_meron', 'ods_wala', 'final_meron_ods', 'final_wala_ods');
    }
}
