<?php

namespace Botble\RealEstate\Enums;

use Botble\Base\Facades\Html;
use Botble\Base\Supports\Enum;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * @method static PropertyFurnishingStatusEnum NEW_LAUNCH()
 * @method static PropertyFurnishingStatusEnum UNDER_CONSTRUCTION()
 * @method static PropertyFurnishingStatusEnum READY_TO_MOVE()
 */
class PropertyFurnishingStatusEnum extends Enum
{
    public const FURNISHED = 'furnished';

    public const SEMI_FURNISHED = 'semi_furnished';

    public const UNFURNISHED = 'unfurnished';


    public static $langPath = 'plugins/real-estate::property.statuses';

    public function toHtml(): HtmlString|string|null
    {
        if (! is_in_admin()) {
            return match ($this->value) {
              
                self::FURNISHED => Html::tag('span', self::PRE_SALE()->label(), ['class' => 'label-success status-label'])
                                        ->toHtml(),
                self::SEMI_FURNISHED => Html::tag('span', self::SELLING()->label(), ['class' => 'label-success status-label'])
                                        ->toHtml(),
                self::UNFURNISHED => Html::tag('span', self::SOLD()->label(), ['class' => 'label-danger status-label'])
                                        ->toHtml(),
                default => null,
            };
        }

        $color = match ($this->value) {
            self::FURNISHED => 'secondary',
            self::SEMI_FURNISHED => 'info',
            self::UNFURNISHED => 'success',
            default => null,
        };

        return Blade::render(sprintf('<x-core::badge color="%s" label="%s" />', $color, $this->label()));
    }
}
