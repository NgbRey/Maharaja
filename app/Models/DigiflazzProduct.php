<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigiflazzProduct extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'buyer_sku_code','product_name','brand','category','type','seller_name',
        'price','unlimited_stock','stock','multi','buyer_product_status','seller_product_status',
        'start_cut_off','end_cut_off','desc','is_visible',
    ];

    protected $casts = [
        'price'=>'integer','unlimited_stock'=>'boolean','multi'=>'boolean',
        'buyer_product_status'=>'boolean','seller_product_status'=>'boolean','is_visible'=>'boolean',
    ];
}
