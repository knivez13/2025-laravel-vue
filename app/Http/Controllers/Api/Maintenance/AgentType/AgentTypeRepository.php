<?php

namespace App\Http\Controllers\Api\Maintenance\AgentType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\AgentType;

class AgentTypeRepository extends BaseRepository implements AgentTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:agent_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];
    protected bool $cacheData = true;
    protected string $cacheName = 'agent_types';

    public function __construct(AgentType $model)
    {
        parent::__construct($model);
    }
}
