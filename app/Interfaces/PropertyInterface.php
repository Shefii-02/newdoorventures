<?php

namespace App\Interfaces;

use App\Models\Property;
use App\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PropertyInterface extends RepositoryInterface
{
    public function getRelatedProperties(int $propertyId, int $limit = 4, array $with = [], array $extra = []): Collection|LengthAwarePaginator;

    public function getProperties(array $filters = [], array $params = []): Collection|LengthAwarePaginator;

    public function getProperty(int $propertyId, array $with = [], array $extra = []): ?Property;

    public function getPropertiesByConditions(array $condition, int $limit = 4, array $with = []): Collection|LengthAwarePaginator;
}
