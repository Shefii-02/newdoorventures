<?php

namespace App\Models;

use App\Models\BaseModel;
use Botble\RealEstate\Enums\CouponTypeEnum;

class Contact extends BaseModel
{
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'content',
        'status',
    ];
   
}
