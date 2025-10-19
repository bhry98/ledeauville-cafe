<?php

namespace App\Models\orders;

use App\Enums\orders\OrdersItemsStatusEnum;
use App\Models\items\ItemsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdersItemsModel extends Model
{
    protected $table = 'orders_items';
    protected $fillable = [
        'id',
        'order_id',
        'item_id',
        'status',
        'amount',
        'price',
        'discount',
        'final_price',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'price' => 'integer',
            'discount' => 'integer',
            'final_price' => 'integer',
            'note' => 'string',
            'status' => OrdersItemsStatusEnum::class,
        ];
    }

//    public function item(): HasOne
//    {
//        return $this->hasOne(ItemsModel::class, 'id', 'item_id');
//    }
    public function item(): BelongsTo
    {
        return $this->belongsTo(ItemsModel::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(OrdersModel::class, 'id', 'order_id');
    }

}
