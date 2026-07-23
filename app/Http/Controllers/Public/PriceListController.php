<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DigiflazzProduct;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    public function index(Request $request)
    {
        $q = DigiflazzProduct::query()
              ->where('is_visible', true)
              ->where('buyer_product_status', true)     // hanya yang aktif di buyer
              ->where('seller_product_status', true);   // dan di seller

        if ($brand = $request->brand)    $q->where('brand', 'like', "%$brand%");
        if ($cat   = $request->category) $q->where('category', 'like', "%$cat%");
        if ($s     = $request->s)        $q->where('product_name', 'like', "%$s%");

        $products = $q->orderBy('brand')->orderBy('product_name')->paginate(30);

        // untuk dropdown filter
        $brands    = DigiflazzProduct::select('brand')->distinct()->pluck('brand')->filter();
        $categories= DigiflazzProduct::select('category')->distinct()->pluck('category')->filter();

        return view('pages/daftar-harga', compact('products','brands','categories'));
    }
}
