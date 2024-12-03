<?php

namespace App\Enums;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * @method static PropertyTypeEnum SALE()
 * @method static PropertyTypeEnum RENT()
 */

enum PropertyTypeEnum: string
{
    public const SALE = 'sale';

    public const RENT = 'rent';


    // public function toHtml(): HtmlString|string|null
    // {
    //     $color = match ($this->value) {
    //         self::SALE => 'success',
    //         self::RENT => 'info',
    //         default => null,
    //     };

    //     return Blade::render(sprintf('<x-core::badge color="%s" label="%s" />', $color, $this->label()));
    // }

     public function toHtml(): HtmlString
    {
        $class = match ($this) {
            self::SALE => 'success',
            self::RENT => 'info',
        };

        return new HtmlString(
            sprintf('<span class="%s">%s</span>', $class, $this->label())
        );
    }
}
