<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','image_path','link_url','is_active','sort'];

    // scope aktif + urutan
    public function scopeActive($q){ return $q->where('is_active', true); }
    public function getUrlAttribute(){ return $this->link_url ?: '#'; }
    public function getSrcAttribute()
    {
    $path = $this->image_path;
    // buang prefix "public/" kalau ada
    $path = preg_replace('#^public/#', '', $path);
    return asset('storage/'.$path);
    }
}
