<?php

namespace App\Services\Abstracts;

use App\Models\Project;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

abstract class StoreProjectCategoryServiceAbstract
{
    public function __construct(protected CategoryInterface $categoryRepository)
    {
    }

    abstract public function execute(Request $request, Project $project);
}
