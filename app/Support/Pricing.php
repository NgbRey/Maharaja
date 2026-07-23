<?php
// app/Support/Pricing.php
namespace App\Support;

use App\Models\PricingRules;
use App\Models\DigiflazzProduct;

class Pricing {
  public static function sellingPrice(DigiflazzProduct $p): int {
    $base = (int) $p->price;

    $rules = PricingRules::where('enabled',true)
      ->where(function($q) use ($p) {
        $q->where(fn($q) => $q->where('scope_type','global'))
          ->orWhere(fn($q) => $q->where('scope_type','brand')->where('scope_value',$p->brand))
          ->orWhere(fn($q) => $q->where('scope_type','category')->where('scope_value',$p->category))
          ->orWhere(fn($q) => $q->where('scope_type','sku')->where('scope_value',$p->buyer_sku_code));
      })->orderBy('id')->get();

    $price = $base;
    foreach ($rules as $r) {
      if ($r->mode === 'flat')    $price += (int) $r->value;
      if ($r->mode === 'percent') $price += (int) round($base * ($r->value/100));
    }
    return max(0, $price);
  }
}
