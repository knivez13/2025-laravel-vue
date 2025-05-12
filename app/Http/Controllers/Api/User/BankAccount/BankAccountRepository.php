<?php

namespace App\Http\Controllers\Api\User\BankAccount;

use Illuminate\Http\Request;
use App\Models\User\BankAccount;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;

class BankAccountRepository extends BaseRepository implements BankAccountInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = false;
    protected string $cacheName = 'video_type';

    public function __construct(BankAccount $model)
    {
        parent::__construct($model);
    }
}
