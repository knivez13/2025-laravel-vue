<?php

namespace App\Http\Controllers\Api\GameController\Sabong;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\GameModerator\GameList;

class SabongRepository extends BaseRepository implements SabongInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:bank_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'bank_types';

    public function __construct(GameList $model)
    {
        parent::__construct($model);
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
