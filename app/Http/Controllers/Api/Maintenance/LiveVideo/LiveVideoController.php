<?php

namespace App\Http\Controllers\Api\Maintenance\LiveVideo;

use App\Helper\ApiCheckEnc;
use App\Helper\ApiResponse;
use App\Helper\AccessHelper;
use Illuminate\Http\Request;
use App\Helper\ApiEncResponse;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\GameType;
use App\Models\Maintenance\VideoType;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Api\Maintenance\LiveVideo\LiveVideoInterface;

class LiveVideoController extends Controller
{
    protected $interface;

    public function __construct(LiveVideoInterface $interface)
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
            $res['video_type'] =  Cache::rememberForever('video_type', fn() => VideoType::get());
            $res['game_type'] =  Cache::rememberForever('game_type', fn() => GameType::get());

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
                $newRequest = new Request($data['head']);
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
                $newRequest = new Request($data['head']);
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
