<?php

namespace App\Models\tables;

use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TablesPlacesModel extends Model
{
    use HasCode;

    protected $table = 'table_places';
    protected $fillable = [
        'id',
        'code',
        'name',
    ];

    public function tables(): HasMany
    {
        return $this->hasMany(TablesModel::class, 'table_place_id', 'id');
    }
}
