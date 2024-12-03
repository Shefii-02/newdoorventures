<?php

namespace App\Services\Abstracts;

use App\Models\Property;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

abstract class StorePropertyCategoryServiceAbstract
{
    public function __construct(protected CategoryInterface $categoryRepository)
    {
    }

    abstract public function execute(Request $request, Property $property);
}
