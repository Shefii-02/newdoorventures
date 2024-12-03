<?php

namespace AppServices;

use App\Models\Project;
use App\Services\Abstracts\StoreProjectCategoryServiceAbstract;
use Illuminate\Http\Request;

class StoreProjectCategoryService extends StoreProjectCategoryServiceAbstract
{
    public function execute(Request $request, Project $project): void
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $project->categories()->sync($categories);
            } else {
                $project->categories()->detach();
            }
        }
    }
}
