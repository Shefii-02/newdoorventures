<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class Investor extends BaseModel
{
    protected $table = 're_investors';

    protected $fillable = [
        'name',
        'website',
        'ongoing',
        'completed',
        'description',
        'status',
    ];
    

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'website' => SafeContent::class,
        'ongoing' => SafeContent::class,
        'completed' => SafeContent::class,
        'description' => SafeContent::class,
    ];


    public function image(): BelongsTo
    {
        return $this->belongsTo(MediaFile::class, 'logo', 'id')->withDefault();
    }

    public function getImageUrlAttribute()
    {
        return $this->image && $this->image->url ? asset('storage/' . $this->image->url) : '';
    }

}
