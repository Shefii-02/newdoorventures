<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class ProjectPriceVariations extends BaseModel
{
    protected $table = 're_project_price_variations';
    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'unit_type',
        'size',
        'price',	

    ];

}
