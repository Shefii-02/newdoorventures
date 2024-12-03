<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use App\Facades\RvMedia;
use App\Models\MediaFile;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PgRules extends BaseModel
{
    protected $table = 're_rules';

    protected $fillable = [
        'name',
        'icon',
        'type',
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
        return $this->image && $this->image->url ? asset('storage/' . $this->image->url) : '';
    }

    public function getRuleByName($name)
    {
        return $this->where('name', $name)->first();
    }



}
