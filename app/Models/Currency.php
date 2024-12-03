<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;

class Currency extends BaseModel
{
    protected $table = 're_currencies';

    protected $fillable = [
        'title',
        'symbol',
        'is_prefix_symbol',
        'order',
        'decimals',
        'is_default',
        'exchange_rate',
    ];

    protected $casts = [
        'title' => SafeContent::class,
    ];
}
