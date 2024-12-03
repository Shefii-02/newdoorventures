<?php

namespace Botble\RealEstate\Enums;

use Botble\Base\Supports\Enum;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * @method static ConsultStatusEnum UNREAD()
 * @method static ConsultStatusEnum READ()
 */
class RegisterStatusEnum extends Enum
{
    public const REGISTERED = 'registered';

    public const UNREGISTERED = 'unregistered';

    public static $langPath = 'plugins/real-estate::consult.statuses';

    public function toHtml(): HtmlString|string|null
    {
        $color = match ($this->value) {
            self::REGISTERED => 'warning',
            self::UNREGISTERED => 'success',
            default => null,
        };

        return Blade::render(sprintf('<x-core::badge color="%s" label="%s" />', $color, $this->label()));
    }
}
