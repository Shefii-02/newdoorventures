<?php

namespace App\Services;

use App\Models\Property;
use App\Services\Abstracts\StorePropertyCategoryServiceAbstract;
use Illuminate\Http\Request;

class StorePropertyCategoryService extends StorePropertyCategoryServiceAbstract
{
    public function execute(Request $request, Property $property): void
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $property->categories()->sync($categories);
            } else {
                $property->categories()->detach();
            }
        }
    }
}
