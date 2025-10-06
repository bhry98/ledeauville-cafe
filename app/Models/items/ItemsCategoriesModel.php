<?php

namespace App\Models\items;

use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemsCategoriesModel extends Model
{
    use HasCode;

    protected $table = 'item_categories';
    protected $fillable = [
        'id',
        'code',
        'name',
    ];

    public function items(): HasOne
    {
        return $this->hasOne(ItemsModel::class, 'category_id', 'id');
    }
}
