<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaFile;
use App\Facades\RvMedia;

class FacilityDistance extends BaseModel
{
    protected $table = 're_facilities_distances';
    public $timestamps = false;

}