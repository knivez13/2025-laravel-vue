<?php

namespace App\Http\Controllers\Api\User\UserList;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\ImageUploadService;


class UserListRepository extends BaseRepository implements UserListInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['name', 'email']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy', 'roles'];
    protected array $filteredInsertData = ['name', 'email'];

    public function __construct(User $model)
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
