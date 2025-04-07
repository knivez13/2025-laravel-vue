<?php

namespace App\Http\Controllers\Api\Maintenance\FileType;

use App\Helper\ApiResponse;
use App\Helper\AccessHelper;
use Illuminate\Http\Request;
use App\Helper\ApiEncResponse;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Maintenance\FileType\FileTypeInterface;

class FileTypeController extends Controller
{
    protected $interface;

    public function __construct(FileTypeInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');

            $data = $request->has('encrypt') || strpos(json_encode($request->all()), 'encrypt') !== false
                ? new Request(ApiEncResponse::decryptJson($request['encrypt']))
                : $request;

            $filters = $data->only(['keyword']);
            $perPage = (int) $data->input('rows', 10);
            $sortBy = $data->input('sortBy', 'id');
            $sortOrder = $data->input('sortOrder', 'asc');
            $page =  $data->input('page', 1);

            $res = $this->interface->paginateWithFilters($filters, $perPage, $sortBy, $sortOrder, $page);

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
            return ApiResponse::success($res, 'deleted success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }
}
