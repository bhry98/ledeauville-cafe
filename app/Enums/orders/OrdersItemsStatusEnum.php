<?php

namespace App\Enums\orders;

use BackedEnum;
use Filament\Schemas\Components\Icon;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

enum OrdersItemsStatusEnum implements HasIcon, HasColor, HasLabel, HasDescription
{
    case Preparing;
    case Delivered;
    case Cancelled;

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Preparing => __("orders.status-label.preparing"),
            self::Delivered => __("orders.status-label.delivered"),
            self::Cancelled => __("orders.status-label.cancelled"),

        };
    }

    public function getDescription(): string|Htmlable|null
    {
        return match ($this) {
            self::Preparing => __("orders.status.preparing.description"),
            self::Delivered => __("orders.status.delivered.description"),
            self::Cancelled => __("orders.status.cancelled.description"),
        };
    }

    public function getIcon(): string|BackedEnum|null
    {
        return match ($this) {
            self::Preparing => Heroicon::ArrowPath,
            self::Delivered => Heroicon::CheckBadge,
            self::Cancelled => Heroicon::XCircle,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Preparing => Color::Sky,
            self::Delivered => Color::Green,
            self::Cancelled => Color::Red,
        };
    }
}
