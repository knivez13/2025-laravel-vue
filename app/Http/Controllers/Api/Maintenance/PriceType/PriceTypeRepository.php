<?php

namespace App\Http\Controllers\Api\Maintenance\PriceType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Models\Maintenance\PriceType;
use App\Http\Controllers\Api\Maintenance\PriceType\PriceTypeInterface;

class PriceTypeRepository extends BaseRepository implements PriceTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:price_types,code'],
        'description' => ['required', 'string'],
        'payment_frequency' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description', 'payment_frequency']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description', 'payment_frequency'];

    public function __construct(PriceType $model)
    {
        parent::__construct($model);
    }
}
