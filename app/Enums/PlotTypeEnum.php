<?php

namespace Botble\RealEstate\Enums;

use Botble\Base\Supports\Enum;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * @method static PlotTypeEnum SALE()
 * @method static PlotTypeEnum RENT()
 */
class PlotTypeEnum extends Enum
{

    public const PLOTRENT = 'plot_rent';

    public const PLOTSALE = 'plot_sale';


    public static $langPath = 'plugins/real-estate::property.types';

    public function toHtml(): HtmlString|string|null
    {
        $color = match ($this->value) {
            self::PLOTSALE => 'success',
            self::PLOTRENT => 'info',
            default => null,
        };

        return Blade::render(sprintf('<x-core::badge color="%s" label="%s" />', $color, $this->label()));
    }
}
