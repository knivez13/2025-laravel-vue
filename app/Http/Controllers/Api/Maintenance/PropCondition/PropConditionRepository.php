<?php

namespace App\Http\Controllers\Api\Maintenance\PropCondition;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\PropCondition;
use App\Http\Controllers\Api\Maintenance\PropCondition\PropConditionInterface;

class PropConditionRepository extends BaseRepository implements PropConditionInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_conditions,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropCondition $model)
    {
        parent::__construct($model);
    }
}
