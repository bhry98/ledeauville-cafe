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

enum OrdersStatusEnum implements HasIcon, HasColor, HasLabel, HasDescription
{
    case Open;
    case Cancelled;
    case Paid;

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Open => __("orders.status.open.label"),
            self::Paid => __("orders.status.paid.label"),
            self::Cancelled => __("orders.status.cancel.label"),
        };
    }

    public function getDescription(): string|Htmlable|null
    {
        return match ($this) {
            self::Open => __("orders.status.open.description"),
            self::Paid => __("orders.status.paid.description"),
            self::Cancelled => __("orders.status.cancel.description"),
        };
    }

    public function getIcon(): string|BackedEnum|null
    {
        return match ($this) {
            self::Open => Heroicon::FolderOpen,
            self::Paid => Heroicon::CurrencyDollar,
            self::Cancelled => Heroicon::XCircle,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Open => Color::Sky,
            self::Paid => Color::Green,
            self::Cancelled => Color::Red,
        };
    }
}
