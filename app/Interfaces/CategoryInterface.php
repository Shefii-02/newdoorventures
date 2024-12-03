<?php

namespace App\Interfaces;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryInterface extends RepositoryInterface
{
    public function getCategories(array $select, array $orderBy): Collection;
}
