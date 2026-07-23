<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CatalogProductMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'section','slug','digiflazz_product_id','is_active','sort_order'
    ];

    public function digiflazzProduct() {
        return $this->belongsTo(DigiflazzProduct::class);
    }

    public function scopeActive(Builder $q): Builder {
        return $q->where('is_active', true);
    }
}
