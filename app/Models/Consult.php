<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use App\Facades\RvMedia;
// use Botble\RealEstate\Enums\ConsultStatusEnum;
// use Botble\RealEstate\QueryBuilders\ConsultBuilder;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consult extends BaseModel
{
    protected $table = 're_consults';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
        'project_id',
        'property_id',
        'ip_address',
        'status',
    ];

    protected $casts = [
        'status' => SafeContent::class,
        'name' => SafeContent::class,
        'content' => SafeContent::class,
    ];

    // public function newEloquentBuilder($query): ConsultBuilder
    // {
    //     return new ConsultBuilder($query);
    // }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    // protected function avatarUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: function () {
    //             try {
    //                 return (new Avatar())->create($this->name)->toBase64();
    //             } catch (Exception) {
    //                 return '';
    //             }
    //         },
    //     );
    // }
}
