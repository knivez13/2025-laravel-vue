<?php

namespace App\Http\Controllers\Api\Maintenance\PriceType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Services\ImageUploadService;
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
    public function preprocessBeforeStore(array $data): array
    {
        if (isset($data['file_path'])) {
            $input['file_path'] = ImageUploadService::upload($data['file_path'], 'upload');
        }
        // Add or modify data before storing
        $data['created_by'] = auth()->id(); // Add the ID of the authenticated user
        $data['created_at'] = now(); // Add the current timestamp
        return $data;
    }

    public function preprocessBeforeUpdate(int $id, array $data): array
    {
        // Add or modify data before updating
        $data['updated_by'] = auth()->id(); // Add the ID of the authenticated user
        $data['updated_at'] = now(); // Add the current timestamp
        return $data;
    }
}
