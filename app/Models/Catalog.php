<?php
// app/Models/Catalog.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = ['name','slug','sort'];

    public function products()
    {
        return $this->belongsToMany(DigiflazzProduct::class, 'catalog_product')
            ->withPivot(['is_visible','sort'])
            ->withTimestamps()
            ->orderBy('pivot_sort');
    }
}
