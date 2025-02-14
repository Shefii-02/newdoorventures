<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;
use App\Facades\RvMedia;
use Botble\RealEstate\Enums\ProjectStatusEnum;
use Botble\RealEstate\QueryBuilders\ProjectBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static \Botble\RealEstate\QueryBuilders\ProjectBuilder<static> query()
 */
class Project extends BaseModel
{
    protected $table = 're_projects';
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'content',
        'location',
        'images',
        'cover_image',
        'status',
        'is_featured',
        'investor_id',
        'number_block',
        'number_floor',
        'number_flat',
        'date_finish',
        'date_sell',
        'price_from',
        'price_to',
        'currency_id',
        'city_id',
        'state_id',
        'country_id',
        'author_id',
        'author_type',
        'category_id',
        'latitude',
        'longitude',
        'unique_id',
        'rera_status',
        'rera_reg_no',
        'videos',
        'youtube_video',
        'master_plan_images',
        'rent_properties',
        'resale_properties',
        'construction_status',
        'city',
        'locality',
        'sub_locality',
        'landmark',
        'possession',
        'keywords',
    ];

    protected $casts = [
        'status' => SafeContent::class,
        'date_finish' => 'datetime',
        'date_sell' => 'datetime',
        'price_from' => 'float',
        'price_to' => 'float',
        'number_block' => 'int',
        'number_float' => 'int',
        'number_flat' => 'int',
        'views' => 'int',
        'is_featured' => 'boolean',
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'content' => SafeContent::class,
        'location' => SafeContent::class,
        'images' => 'json',
        'master_plan_images' => 'json',
        'videos' => 'json',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Project $project) {
            $project->categories()->detach();
            $project->customFields()->delete();
            $project->reviews()->delete();
            $project->features()->detach();
            $project->facilities()->detach();
            $project->properties()->update(['project_id' => 0]);
            // $project->metadata()->delete();
        });
    }

    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    public function getYoutubeVideoUrlAttribute()
    {
        return $this->youtube_video ? str_replace('https://youtu.be/', '', $this->youtube_video) : null;
    }


    public function getYoutubeVideoAttribute($value)
    {
        return $value ? 'https://youtu.be/' . $value : null;
    }



    /**
     * @deprecated
     */
    public function property(): HasMany
    {
        return $this->properties();
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'project_id');
    }

    public function investor()
    {
        return $this->hasOne(Investor::class, 'id', 'investor_id');
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 're_project_features', 'project_id', 'feature_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'project_id', 'id');
    }

    public function priceVariations()
    {
        return $this->hasMany(ProjectPriceVariations::class, 'project_id', 'id');
    }


    public function facilities(): BelongsToMany
    {
        return $this->morphToMany(Facility::class, 'reference', 're_facilities_distances')->withPivot('distance');
    }


    public function configration(): BelongsToMany
    {
        return $this->morphToMany(Configration::class, 'reference', 're_configration_details')->withPivot('distance');
    }


    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 're_project_categories');
    }

    // protected function image(): Attribute
    // {
    //     return Attribute::make(
    //         get: function () {
    //             return Arr::first($this->images) ?? null;
    //         },
    //     );
    // }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                return !empty($this->cover_image) ? $this->cover_image : Arr::first($this->images) ?? null;
            },
        );
    }

    protected function address(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->location;
            },
        );
    }

    protected function category(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->categories->first() ?: new Category();
            },
        );
    }

    protected function statusHtml(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->status->toHtml();
            },
        );
    }

    protected function categoryName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->category->name;
            },
        );
    }

    protected function imageThumb(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image ? $this->image : null;
            },
        );
    }

    protected function imageSmall(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image ? $this->image : null;
            },
        );
    }

    protected function mapIcon(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->name;
            },
        );
    }

    protected function cityName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->city;
            },
        );
    }

    public function customFields(): MorphMany
    {
        return $this->morphMany(CustomFieldValue::class, 'reference', 'reference_type', 'reference_id')->with('customField.options');
    }

    protected function constructionStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return match ($value) {
                    'old_projects' => 'Ready to move',
                    default => $value,
                };
            },
        );
    }

    protected function setConstructionStatus(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value === 'Ready to move' ? 'old_projects' : $value,
        );
    }
    


    protected function customFieldsArray(): Attribute
    {
        return Attribute::make(
            get: function () {
                return CustomFieldValue::getCustomFieldValuesArray($this);
            },
        );
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    // public function newEloquentBuilder($query): ProjectBuilder
    // {
    //     return new ProjectBuilder($query);
    // }
}
