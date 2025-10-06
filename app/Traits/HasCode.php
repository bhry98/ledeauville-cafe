<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait HasCode
{
    public static function bootHasCode(): void
    {
        static::creating(function ($model) {
            if ($model->isFillable('code') || Schema::hasColumn($model->getTable(), 'code')) {
                if (empty($model->code)) {
                    do {
                        $code = Str::upper(Str::random(10));
                    } while (self::query()->where('code', $code)->exists());
                    $model->code = $code;
                }
            }
        });
    }
}
