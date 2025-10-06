<?php

namespace App\Models\items;

use App\Models\tables\TablesPlacesModel;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemsModel extends Model
{
    use HasCode;

    protected $table = 'items';

    public function getRouteKeyName(): string
    {
        return 'code';
    }

    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ItemsCategoriesModel::class, 'category_id', 'id');
    }
}
