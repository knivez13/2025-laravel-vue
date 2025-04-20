<?php

namespace App\Http\Controllers\Api\Maintenance\AgentGameCommission;

use App\Repositories\BaseRepository;
use App\Models\Maintenance\AgentGameCommission;


class AgentGameCommissionRepository extends BaseRepository implements AgentGameCommissionInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(AgentGameCommission $model)
    {
        parent::__construct($model);
    }
}
