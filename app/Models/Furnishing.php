<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class Furnishing extends BaseModel
{
    protected $table = 're_furnishing';

    public $timestamps = false;

    protected $fillable = [
        'name',
        // 'icon',
    ];

    protected $casts = [
        'name' => SafeContent::class,
        'icon' => SafeContent::class,
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class, 'icon', 'id')->withDefault();
    }

    public function getImageUrlAttribute()
    {
        return $this->image && $this->image->url ? asset('images/' . $this->image->url) : '';
    }


    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 're_property_furnishing', 'furnishing_id', 'property_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 're_project_furnishing', 'furnishing_id', 'project_id');
    }
}
