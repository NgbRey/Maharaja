<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use App\Models\Banner;

class HomeController extends Controller
{
    public function __invoke()
    {
        // Ambil data + normalisasi kategori (case-insensitive) + hanya yang aktif
        $games   = CatalogProduct::where('is_active',1)->whereRaw("LOWER(category)='games'")->orderBy('sort')->get();
        $pulsa   = CatalogProduct::where('is_active',1)->whereRaw("LOWER(category)='pulsa'")->orderBy('sort')->get();
        $lainnya = CatalogProduct::where('is_active',1)->whereRaw("LOWER(category)='lainnya'")->orderBy('sort')->get();

        $banners = Banner::where('is_active',1)->orderBy('sort')->get();

        // DEBUG KERAS — biar pasti keliatan di layar kalau route & controller sudah benar:
        // dd($games->pluck('name'), $pulsa->pluck('name'), $lainnya->pluck('name'));

        return view('public.home', compact('banners','games','pulsa','lainnya'));
    }
}
