<?php

namespace App\Http\Controllers\Api\Maintenance\PropType;

use App\Helper\ApiResponse;
use App\Helper\AccessHelper;
use Illuminate\Http\Request;
use App\Helper\ExceptionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Api\Maintenance\PropType\PropTypeInterface;

class PropTypeController extends Controller
{
    protected $interface;

    public function __construct(PropTypeInterface $interface)
    {
        $this->interface = $interface;
    }

    public function index(Request $request)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $filters = $request->only(['search']); // Include date filters
            $perPage = $request->input('per_page', 10);
            $sortBy = $request->input('sort_by', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $res = $this->interface->paginateWithFilters($filters, $perPage, $sortBy, $sortOrder);
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
            $res = $this->interface->create($request->all());
            return ApiResponse::success($res, 'insert success');
        } catch (\Throwable $e) {
            return ExceptionHelper::handle($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            AccessHelper::check('CanAddMaintenance');
            $res = $this->interface->update($id, $request->all());
            return ApiResponse::success($res, 'update success');
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
