<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogProduct;
use App\Models\{Catalog, DigiflazzProduct};
use App\Http\Requests\Admin\CatalogProductRequest; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductCardController extends Controller
{
    public function index()
    {
        $items = CatalogProduct::orderBy('category')->orderBy('sort')->latest()->paginate(18);
        return view('admin.catalog.index', compact('items'));
    }

    public function create()
    {
        return view('admin.catalog.create');
    }

    public function store(CatalogProductRequest $r)
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            $data['thumbnail_path'] = $r->file('image')->store('catalog','public');
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        CatalogProduct::create($data);
        return redirect()->route('admin.catalog.index')->with('ok','Kartu katalog dibuat.');
    }

    public function edit(CatalogProduct $catalog)
    {
        return view('admin.catalog.edit', ['item' => $catalog]);
    }

    public function update(CatalogProductRequest $r, CatalogProduct $catalog)
    {
        $data = $r->validated();
        if ($r->hasFile('image')) {
            if ($catalog->thumbnail_path) Storage::disk('public')->delete($catalog->thumbnail_path);
            $data['thumbnail_path'] = $r->file('image')->store('catalog','public');
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        $catalog->update($data);
        return redirect()->route('admin.catalog.index')->with('ok','Kartu katalog diupdate.');
    }

    public function destroy(CatalogProduct $catalog)
    {
        if ($catalog->thumbnail_path) Storage::disk('public')->delete($catalog->thumbnail_path);
        $catalog->delete();
        return back()->with('ok','Kartu katalog dihapus.');
    }


}
