<?php

namespace App\Models;

use App\Casts\SafeContent;
use Botble\Base\Contracts\HasTreeCategory as HasTreeCategoryContract;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Botble\Base\Traits\HasTreeCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class Category extends BaseModel
{
    // use HasTreeCategory;

    protected $table = 're_categories';

    protected $fillable = [
        'name',
        'description',
        'status',
        'order',
        'is_default',
        'parent_id',
        'has_rent',
        'has_sell',
        'has_pg', 
        'has_residential', 
        'has_commercial',
    ];

    public function newQuery($excludeDeleted = true)
    {
        return parent::newQuery($excludeDeleted)->orderBy('order', 'asc'); // Replace 'column_name' with your desired column
    }

   

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
    ];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 're_property_categories')->with('slugable');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 're_project_categories')->with('slugable');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    protected function badgeWithCount(): Attribute
    {
        return Attribute::get(function (): HtmlString {
            $html = '';

            if ($this->is_default) {
                $html .= Blade::render(sprintf(
                    '<span class="text-success" data-bs-toggle="tooltip" title="%s"><x-core::icon name="ti ti-check" size="sm" /></span>',
                    trans('plugins/real-estate::category.is_default')
                ));
            }

            $html .= Blade::render(sprintf(
                '<span data-bs-toggle="tooltip" title="%s">(%s)</span>',
                trans('plugins/real-estate::category.total_projects', ['total' => $this->projects_count]),
                $this->projects_count,
            ));

            $html .= Blade::render(sprintf(
                '<span data-bs-toggle="tooltip" title="%s">(%s)</span>',
                trans('plugins/real-estate::category.total_properties', ['total' => $this->properties_count]),
                $this->properties_count
            ));

            return new HtmlString($html);
        });
    }

    protected static function booted(): void
    {
        self::deleting(function (Category $category) {
            foreach ($category->children()->get() as $child) {
                $child->parent_id = $category->parent_id;
                $child->save();
            }

            $category->properties()->detach();
            $category->projects()->detach();
        });
    }
}
