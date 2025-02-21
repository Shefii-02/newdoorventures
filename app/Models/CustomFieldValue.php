<?php

namespace App\Models;

use App\Casts\SafeContent;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class CustomFieldValue extends BaseModel
{
    protected $table = 're_custom_field_values';

    protected $fillable = [
        'name',
        'value',
        'reference_id',
        'reference_type',
        'custom_field_id',
    ];

    protected $casts = [
        'name' => SafeContent::class,
        'value' => SafeContent::class,
    ];

    public function customField(): BelongsTo
    {
        return $this->belongsTo(CustomField::class);
    }


    public function setValueAttribute($value)
    {
        $this->attributes['value'] = addslashes($value);
    }


    public function getValueAttribute($value)
    {
        return stripslashes($value);
    }

    public static function getCustomFieldValuesArray(BaseModel $object): array
    {
        $customFields = [];

        foreach ($object->customFields as $item) {
            $customField = [];

            if ($item->customField) {
                $customField = [
                    'id' => $item->customField->id,
                    'name' => $item->customField->name,
                    'type' => $item->customField->type,
                    'options' => [],
                ];

                foreach ($item->customField->options as $option) {
                    $customField['options'][] = [
                        'id' => $option->id,
                        'label' => $option->label,
                        'value' => $option->value,
                    ];
                }
            }

            $customFields[] = [
                'id' => $item->id,
                'name' => $item->name,
                'value' => $item->value,
                'custom_field_id' => $item->custom_field_id,
                'custom_field' => $customField,
            ];
        }

        return $customFields;
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (! $this->customField) {
                    return $value;
                }

                return $this->customField->name;
            },
        );
    }

    public static function formatCustomFields(array $customFields = []): array
    {
        $newCustomFields = [];

        foreach ($customFields as $item) {
            if ($item['value'] != null) {
                $customField = null;


                // $itemId = self::where('name',$item->name)->pluck('id')->first();
                // dd($itemId);
                // if ($itemId) {
                //     $customField = self::find($itemId);
                //     $customField->fill($item);
                // } else {
                Arr::forget($item, 'id');
                $customField = new self($item);
                // }

                $newCustomFields[] = $customField;
            }
        }

        return $newCustomFields;
    }
}
