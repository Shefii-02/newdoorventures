<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;
use App\Facades\RvMedia;
use App\Enums\ModerationStatusEnum;
use App\Enums\PropertyPeriodEnum;
use App\Enums\PropertyStatusEnum;
use App\Enums\PropertyTypeEnum;
use Botble\RealEstate\QueryBuilders\PropertyBuilder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\MediaFile;

/**
 * @method static \Botble\RealEstate\QueryBuilders\PropertyBuilder<static> query()
 */
class Property extends BaseModel
{
    protected $table = 're_properties';

    protected $fillable = [
        'name',
        'type',
        'description',
        'content',
        'location',
        'images',
        'project_id',
        'number_bedroom',
        'number_bathroom',
        'number_floor',
        'square',
        'price',
        'status',
        'is_featured',
        'currency_id',
        'city_id',
        'state_id',
        'country_id',
        'period',
        'author_id',
        'author_type',
        'expire_date',
        'auto_renew',
        'latitude',
        'longitude',
        'unique_id',
        'moderation_status',
    ];

    protected $casts = [
        // 'status' => PropertyStatusEnum::class,
        // 'moderation_status' => ModerationStatusEnum::class,
        // 'type' => PropertyTypeEnum::class,
        // 'period' => PropertyPeriodEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'content' => SafeContent::class,
        'location' => SafeContent::class,
        'expire_date' => 'datetime',
        'images' => 'json',
        'video' => 'json',
        'price' => 'float',
        'square' => 'float',
        'number_bedroom' => 'int',
        'number_bathroom' => 'int',
        'number_floor' => 'int',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Property $property) {
            $property->categories()->detach();
            $property->customFields()->delete();
            $property->reviews()->delete();
            $property->features()->detach();
            $property->facilities()->detach();
            $property->pg_rules()->detach();
            $property->furnishing()->detach();
            $property->metadata()->delete();
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class, 're_property_features', 'property_id', 'feature_id');
    }

    public function facilities(): BelongsToMany
    {
        return $this->morphToMany(Facility::class, 'reference', 're_facilities_distances')->withPivot('distance');
    }

    public function furnishing(): BelongsToMany
    {
        return $this->belongsToMany(Furnishing::class, 're_property_furnishing', 'property_id', 'furnishing_id');
    }
    
    public function pg_rules()
    {
        return $this->hasMany(RuleDetails::class, 'reference_id', 'id')->where('reference_type','App\Models\Property');

    }

    
    

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                return Arr::first($this->images) ?? null;
            },
        );
    }



    public function video_collect()
    {
        return $this->hasOne(MediaFile::class, 'id', 'video')->withDefault();
    }

    public function getVideoUrlAttribute()
    {
        return $this->video_collect && $this->video_collect->url ? asset('storage/' . $this->video_collect->url) : '';
    }

   
    

    protected function squareText(): Attribute
    {
        return Attribute::make(
            get: function () {
                $square = $this->square;

                $unit = 'sq.ft';

                return  (sprintf('%s %s', number_format($square), __($unit)));
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

    public function account(){
        return $this->hasOne(Account::class,  'id', 'author_id');
    }


    protected function category(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->categories->first() ?: new Category();
            },
        );
    }

    public function getYoutubeVideoUrlAttribute()
    {
        return $this->youtube_video ? str_replace('https://youtu.be/','',$this->youtube_video) : null;
    }
    

    public function getYoutubeVideoAttribute($value)
    {
        return $value ? 'https://youtu.be/' . $value : null;
    }
    

    
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function author(): MorphTo
    {
        return $this->morphTo()->withDefault();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 're_property_categories');
    }


    protected function cityName(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->city;
            },
        );
    }

    protected function typeHtml(): Attribute
    {
        // ->label()
        return Attribute::make(
            get: function () {
                return $this->type;
            },
        );
    }

    protected function statusHtml(): Attribute
    {
        // ->toHtml()
        return Attribute::make(
            get: function () {
                return $this->status;
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
                return $this->image ? asset('images/'.$this->image) : null;
            },
        );
    }

    protected function imageSmall(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->image ? asset('images/'.$this->image) : null;
            },
        );
    }

    protected function priceHtml(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->price) {
                    return __('Contact');
                }

                $price = $this->price_format;
                // ->label()
                if ($this->type == PropertyTypeEnum::RENT) {
                    $price .= ' / ' . Str::lower($this->period);
                }

                return $price;
            },
        );
    }

    protected function priceFormat(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! $this->price) {
                    return __('Contact');
                }

                if ($this->price_formatted) {
                    return $this->price_formatted;
                }

                $currency = $this->currency;

               

                return $this->price_formatted = format_price($this->price, 'IN');
            },
        );
    }

    protected function mapIcon(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->type_html . ': ' . $this->price_format;
            },
        );
    }

    public function customFields(): MorphMany
    {
        return $this->morphMany(CustomFieldValue::class, 'reference', 'reference_type', 'reference_id')->with('customField.options');
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

    // public function newEloquentBuilder($query): PropertyBuilder
    // {
    //     return new PropertyBuilder($query);
    // }



    public function getSlugAttribute($value){
        return $value;
    }
}


