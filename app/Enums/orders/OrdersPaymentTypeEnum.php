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

enum OrdersPaymentTypeEnum implements HasIcon, HasColor, HasLabel, HasDescription
{
    case Cache;
    case Instapay;
    case Visa;
    case Wallet;
    case Other;

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Cache => __("orders.status.cache.label"),
            self::Instapay => __("orders.status.instapay.label"),
            self::Visa => __("orders.status.visa.label"),
            self::Wallet => __("orders.status.wallet.label"),
            self::Other => __("orders.status.other.label"),
        };
    }

    public function getDescription(): string|Htmlable|null
    {
        return match ($this) {
            self::Cache => __("orders.status.cache.description"),
            self::Instapay => __("orders.status.instapay.description"),
            self::Visa => __("orders.status.visa.description"),
            self::Wallet => __("orders.status.wallet.description"),
            self::Other => __("orders.status.other.description"),
        };
    }

    public function getIcon(): string|BackedEnum|null
    {
        return match ($this) {
            self::Cache => Heroicon::Banknotes,
            self::Instapay => Heroicon::DevicePhoneMobile,
            self::Visa => Heroicon::CreditCard,
            self::Wallet => Heroicon::Wallet,
            self::Other => Heroicon::ArrowDownTray,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Cache => Color::Green,
            self::Instapay => Color::Orange,
            self::Visa => Color::Blue,
            self::Wallet => Color::Red,
            self::Other => Color::Gray,
        };
    }
}
