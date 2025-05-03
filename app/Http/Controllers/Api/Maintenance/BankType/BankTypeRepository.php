<?php

namespace App\Http\Controllers\Api\Maintenance\BankType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Maintenance\BankType;
use App\Repositories\BaseRepository;

class BankTypeRepository extends BaseRepository implements BankTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:bank_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(BankType $model)
    {
        parent::__construct($model);
    }
}
