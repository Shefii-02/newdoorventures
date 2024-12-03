<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class ProjectSpecification extends BaseModel
{
    protected $table = 're_project_specifications';
    public $timestamps = false;

    protected $fillable = [
        'image',
        'name',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'description' => SafeContent::class,
        'image' => SafeContent::class,
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class, 'image', 'id')->withDefault();
    }

    public function getImageUrlAttribute()
    {
        return $this->image && $this->image->url ? asset('storage/' . $this->image->url) : '';
    }
}
