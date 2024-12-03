<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Enums\BaseStatusEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RuleDetails extends BaseModel
{
    public $timestamps = false;
    protected $table = 're_rules_details';


    public function rule()
    {
        return $this->belongsTo(PgRules::class, 'rule_id');
    }


    public function property()
    {
        return $this->belongsTo(Property::class, 'reference_id');
    }


}
