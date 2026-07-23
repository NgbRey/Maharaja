<?php

namespace App\Http\Controllers;

use App\Models\CatalogProductMapping;

class ProductPageController extends Controller
{
    public function show(string $section, string $slug)
    {
        $items = CatalogProductMapping::with('digiflazzProduct')
            ->active()
            ->where(compact('section','slug'))
            ->orderBy('sort_order')
            ->get();

        // siapkan koleksi siap pakai di blade
        $products = $items->map(function ($m) {
            $p = $m->digiflazzProduct;
            return (object)[
                'id'    => $p->id,
                'code'  => $p->code,
                'name'  => $p->name,
                // 'note'  => $p->note ?? null,
                'price' => $p->price,
                // 'base_price' => (int)($p->price ?? 0),
                // 'price' => price_with_markup((int)($p->price ?? 0)),
            ];
        });

        $pageTitle = str_replace('-', ' ', ucwords($slug, '-'));

        // Render ke file: resources/views/pages/produk/{section}/halaman.blade.php
        return view("pages.produk.$section.$slug", compact('products','pageTitle','section','slug'));
    }
}
