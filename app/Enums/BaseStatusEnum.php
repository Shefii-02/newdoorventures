<?php
namespace App\Enums;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Facade;

enum BaseStatusEnum: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
    case PENDING = 'pending';

    /**
     * Get the label for the enum.
     */
    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PENDING => 'Pending',
            self::PUBLISHED => 'Published',
        };
    }

    /**
     * Convert the enum to an HTML string.
     */
    public function toHtml(): HtmlString
    {
        $class = match ($this) {
            self::DRAFT => 'badge bg-secondary text-secondary-fg',
            self::PENDING => 'badge bg-warning text-warning-fg',
            self::PUBLISHED => 'badge bg-success text-success-fg',
        };

        return new HtmlString(
            sprintf('<span class="%s">%s</span>', $class, $this->label())
        );
    }
}
