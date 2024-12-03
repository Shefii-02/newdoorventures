<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class Configration extends BaseModel
{
    protected $table = 're_configration';

    protected $fillable = [
        'name',
        'icon',
        'status',
        'has_sell',
        'has_rent',
        'has_pg',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
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


    
}
