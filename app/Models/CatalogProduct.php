<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CatalogProduct extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'category','name','slug','developer','thumbnail_path','is_active','sort'
    ];

    protected static function booted()
    {
        static::creating(fn($m) => $m->slug ??= Str::slug($m->name));
        static::updating(fn($m) => $m->slug ??= Str::slug($m->name));
    }

    // URL gambar siap pakai (auto rapikan "public/")
    public function getThumbAttribute(): string
    {
        $p = preg_replace('#^/??public/#', '', (string)$this->thumbnail_path);
        return $p ? asset('storage/'.$p) : asset('images/placeholder-game.png');
    }
    // Scope helper
    public function scopeActive($q){ return $q->where('is_active', 1); }
    public function scopeByCat($q, $c){ return $q->whereRaw ('LOWER(category)=?', [strtolower($c)]); }
    
}

