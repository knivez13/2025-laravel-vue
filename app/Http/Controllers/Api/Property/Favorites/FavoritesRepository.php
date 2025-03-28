<?php

namespace App\Http\Controllers\Api\Property\Favorites;

use App\Repositories\BaseRepository;
use App\Models\Property\PropertyFavorites;

class FavoritesRepository extends BaseRepository implements FavoritesInterface
{
    protected array $rules = [
        'code' => ['required', 'string', 'unique:amenities,code'],
        'description' => ['required', 'string'],
    ];

    protected array $filterableFields = ['code', 'description']; // Fields to search in
    protected array $relationshipTable = ['createdBy', 'updatedBy'];
    protected array $filteredInsertData = ['code', 'description'];

    public function __construct(PropertyFavorites $model)
    {
        parent::__construct($model);
    }
}
