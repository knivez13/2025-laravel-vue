<?php

namespace App\Http\Controllers\Api\Maintenance\PropType;

use App\Models\Maintenance\PropType;
use App\Repositories\BaseRepository;
use App\Services\ImageUploadService;

class PropTypeRepository extends BaseRepository implements PropTypeInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:prop_types,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropType $model)
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
