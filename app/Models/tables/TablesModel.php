<?php

namespace App\Models\tables;

use App\Enums\orders\OrdersStatusEnum;
use App\Models\orders\OrdersModel;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TablesModel extends Model
{
    use HasCode;

    protected $table = 'tables';
    protected $fillable = [
        'id',
        'code',
        'name',
        'table_number',
        'table_place_id',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'table_number' => 'integer',
            'active' => 'boolean',
        ];
    }


    public function place(): BelongsTo
    {
        return $this->belongsTo(TablesPlacesModel::class, 'table_place_id', 'id');
    }

    public function lastOrder(): HasOne
    {
        return $this->hasOne(OrdersModel::class, 'table_id', 'id')->latest();
    }

    public function openOrder(): HasOne
    {
        return $this->hasOne(OrdersModel::class, 'table_id', 'id')->where('status', OrdersStatusEnum::Open);
    }
}
