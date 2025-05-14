<?php

namespace App\Http\Controllers\Api\Maintenance\GamePresent;

use App\Helper\ApiCheckEnc;
use App\Helper\ApiResponse;
use App\Helper\AccessHelper;
use Illuminate\Http\Request;
use App\Helper\ApiEncResponse;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\GameType;
use App\Models\Maintenance\LiveVideo;
use Illuminate\Support\Facades\Cache;
use App\Models\Maintenance\GameProvider;
use App\Http\Controllers\Api\Maintenance\GamePresent\GamePresentInterface;

class GamePresentController extends Controller
{
    protected $interface;

    public function __construct(GamePresentInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');

            $data = new Request(ApiCheckEnc::check($request['encrypt']));


            $filters = $data->only(['keyword']);
            $perPage = (int) $data->input('rows', 10);
            $sortBy = $data->input('sortBy', 'id');
            $sortOrder = $data->input('sortOrder', 'asc');
            $page =  $data->input('page', 1);

            $res['list'] = $this->interface->paginateWithFilters($filters, $perPage, $sortBy, $sortOrder, $page);
            $res['game_type'] =  Cache::rememberForever('game_type', fn() => GameType::get());
            $res['game_provider'] =  Cache::rememberForever('game_provider', fn() => GameProvider::get());
            $res['live_video'] =  Cache::rememberForever('live_video', fn() => LiveVideo::get());

            return ApiResponse::success($res, 'fetch success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function show($id)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $res = $this->interface->find($id);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function store(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->create($data['data']);
            if ($res) {
                $newRequest = new Request(['encrypt' => ApiEncResponse::encryptJson($data['head'])]);
                return $this->index($newRequest);
            }
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $data = ApiEncResponse::decryptJson($request['encrypt']);
            $res = $this->interface->update($id, $data['data']);
            if ($res) {
                $newRequest = new Request(['encrypt' => ApiEncResponse::encryptJson($data['head'])]);
                return $this->index($newRequest);
            }
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function destroy($id)
    {
        try {
            $res = $this->interface->delete($id);
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
}
