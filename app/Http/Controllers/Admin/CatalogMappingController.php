<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogProductMapping;
use App\Models\DigiflazzProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CatalogMappingController extends Controller
{
    public function index(Request $request)
    {
        $section = $request->get('section', 'games');

        // baca nama file .blade.php di folder sesuai section
        $dir = resource_path("views/pages/produk/{$section}");
        $availableSlugs = collect(File::files($dir ?? ''))
            ->filter(fn($f) => str($f->getFilename())->endsWith('.blade.php'))
            ->map(fn($f) => str($f->getFilename())->before('.blade.php')->value())
            ->sort()
            ->values();

        // fallback slug ke item pertama jika input kosong/invalid
        $slug = $request->get('slug');
        if (!$slug || !$availableSlugs->contains($slug)) {
        $slug = $availableSlugs->first();
        }

        $mappings = CatalogProductMapping::with('digiflazzProduct')
            ->where('section', $section)
            ->where('slug', $slug)
            ->orderBy('sort_order')
            ->get();

        $digiflazz = DigiflazzProduct::query()
            ->when($request->filled('brand'), fn($q) => $q->where('brand','like','%'.$request->brand.'%'))
            ->orderBy('brand')->orderBy('product_name')
            ->limit(200)->get(['id','brand','product_name','price']);

            return view('admin.setProduk.index', compact('mappings','section','slug','digiflazz','availableSlugs'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section' => 'required|in:games,pulsa,lainnya',
            'slug'    => 'required|string|max:120',
            'digiflazz_product_id' => 'required|exists:digiflazz_products,id',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean'
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        CatalogProductMapping::updateOrCreate(
            [
                'section' => $data['section'],
                'slug'    => $data['slug'],
                'digiflazz_product_id' => $data['digiflazz_product_id'],
            ],
            [
                'sort_order' => $data['sort_order'] ?? 0,
                'is_active'  => $data['is_active'],
            ]
        );

        return back()->with('status', 'Produk ditambahkan ke halaman.');
    }

    public function update(Request $request, CatalogProductMapping $mapping)
    {
        $data = $request->validate([
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'nullable|boolean'
        ]);

        $mapping->update([
            'sort_order' => $data['sort_order'] ?? $mapping->sort_order,
            'is_active'  => $request->boolean('is_active', $mapping->is_active),
        ]);

        return back()->with('status', 'Mapping diperbarui.');
    }

    public function destroy(CatalogProductMapping $mapping)
    {
        $mapping->delete();
        return back()->with('status', 'Mapping dihapus.');
    }
}
