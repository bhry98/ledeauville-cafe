<?php

namespace App\Models\orders;

use App\Enums\orders\OrdersStatusEnum;
use App\Models\items\ItemsCategoriesModel;
use App\Models\tables\TablesModel;
use App\Models\users\CustomerModel;
use App\Models\users\UserModel;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdersModel extends Model
{
    use HasCode;

    protected $table = 'orders';

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    protected $fillable = [
        "id",
        "code",
        "cacher_id",
        "table_id",
        "customer_id",
        "status",
        "payment_type",
        "discount",
        "final_price",
        "created_at",
        "updated_at",
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'status' => OrdersStatusEnum::class,
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrdersItemsModel::class, 'order_id', 'id');
    }

    public function cacher(): HasOne
    {
        return $this->hasOne(UserModel::class, 'id', 'cacher_id');
    }

    public function table(): BelongsTo
    {
        return $this->belongsTo(TablesModel::class, 'table_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->cacher_id = auth()->id();
        });
    }
}
