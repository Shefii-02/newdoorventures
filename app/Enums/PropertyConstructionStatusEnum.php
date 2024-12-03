<?php

namespace Botble\RealEstate\Enums;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\Enum;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * @method static PropertyConstructionStatusEnum NEW_LAUNCH()
 * @method static PropertyConstructionStatusEnum UNDER_CONSTRUCTION()
 * @method static PropertyConstructionStatusEnum READY_TO_MOVE()
 */
class PropertyConstructionStatusEnum extends Enum
{
    public const NEW_LAUNCH = 'new_launch';

    public const UNDER_CONSTRUCTION = 'under_construction';

    public const READY_TO_MOVE = 'ready_to_move';


    public static $langPath = 'plugins/real-estate::property.statuses';

    public function toHtml(): HtmlString|string|null
    {
        if (! is_in_admin()) {
            return match ($this->value) {
              
                self::NEW_LAUNCH => 
                Html::tag('span', self::PRE_SALE()->label(), ['class' => 'label-success status-label'])
                    ->toHtml(),
                self::UNDER_CONSTRUCTION => Html::tag('span', self::SELLING()->label(), ['class' => 'label-success status-label'])
                    ->toHtml(),
                self::READY_TO_MOVE => Html::tag('span', self::SOLD()->label(), ['class' => 'label-danger status-label'])
                    ->toHtml(),
                default => null,
            };
        }

        $color = match ($this->value) {
            self::NEW_LAUNCH => 'secondary',
            self::UNDER_CONSTRUCTION => 'info',
            self::READY_TO_MOVE => 'success',
            default => null,
        };

        return Blade::render(sprintf('<x-core::badge color="%s" label="%s" />', $color, $this->label()));
    }
}
