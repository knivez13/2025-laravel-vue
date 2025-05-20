<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use App\Helper\ApiCheckEnc;
use App\Helper\ApiResponse;
use App\Helper\AccessHelper;
use Illuminate\Http\Request;
use App\Helper\ApiEncResponse;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\GameModerator\GameList;
use Illuminate\Support\Facades\Validator;
use App\Models\GameModerator\GameRoundBet;
use App\Models\GameModerator\GameListRound;
use App\Models\Maintenance\GamePresentOption;
use App\Http\Controllers\Api\GameController\Sabong\SabongInterface;

class SabongController extends Controller
{
    protected $interface;

    public function __construct(SabongInterface $interface)
    {
        $this->interface = $interface;
    }

    public function show($id)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $res = $this->interface->sabongConsole($id);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function selectRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->selectRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
    public function nextRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->nextRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
    public function openRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->openRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
    public function closeRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->closeRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
    public function declareRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $validator = Validator::make($data, [
                'win_option_id' => 'required',
            ]);
            if ($validator->fails()) {
                return ApiResponse::failed('Validation Error.', $validator->errors(), 422);
            }
            $res = $this->interface->declareRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function cancelRound(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->cancelRound($data);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    // 0=idel / live
    // 1=current
    // 2=open
    // 3=closed
    // 4=declared /closed
    // 5=cancel
    // 6=lock
    // 7=reset

}
