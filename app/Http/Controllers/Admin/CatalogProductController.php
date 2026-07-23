<?php
// app/Http/Controllers/Admin/CatalogProductController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Catalog, DigiflazzProduct};
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
  public function index(Request $r, Catalog $catalog)
  {
    // produk yang sudah masuk katalog
    $attached = $catalog->products()->withPivot('is_visible','sort')->paginate(30, ['*'], 'attached');

    // cari produk DF untuk ditambahkan
    $q = DigiflazzProduct::query();

    if ($s = $r->input('s'))        $q->where('product_name','like',"%$s%");
    if ($b = $r->input('brand'))    $q->where('brand','like',"%$b%");
    if ($c = $r->input('category')) $q->where('category','like',"%$c%");

    // Exclude yang sudah ter-attach
    $attachedIds = $catalog->products()->pluck('digiflazz_products.id');
    $available = $q->whereNotIn('id', $attachedIds)->paginate(30, ['*'], 'available');

    // data dropdown
    $brands = DigiflazzProduct::select('brand')->distinct()->pluck('brand')->filter();
    $categories = DigiflazzProduct::select('category')->distinct()->pluck('category')->filter();

    return view('admin/catalogs/products', compact('catalog','attached','available','brands','categories'));
  }

  public function attach(Request $r, Catalog $catalog)
  {
    $data = $r->validate(['product_id'=>'required|integer','is_visible'=>'nullable|boolean']);
    $catalog->products()->attach($data['product_id'], [
      'is_visible' => (bool) ($data['is_visible'] ?? true),
      'sort' => 0,
    ]);
    return back()->with('ok','Produk ditambahkan ke katalog.');
  }

  public function attachBulk(Request $r, Catalog $catalog)
  {
    $ids = $r->input('product_ids', []);
    foreach ($ids as $id) {
      if (!$catalog->products()->where('digiflazz_product_id',$id)->exists()) {
        $catalog->products()->attach($id, ['is_visible'=>true,'sort'=>0]);
      }
    }
    return back()->with('ok', count($ids).' produk ditambahkan.');
  }

  public function toggle(Catalog $catalog, DigiflazzProduct $product)
  {
    $row = $catalog->products()->where('digiflazz_product_id',$product->id)->firstOrFail();
    $new = ! (bool) $row->pivot->is_visible;
    $catalog->products()->updateExistingPivot($product->id, ['is_visible'=>$new]);
    return back()->with('ok', 'Visibility diperbarui.');
  }

  public function sort(Request $r, Catalog $catalog, DigiflazzProduct $product)
  {
    $data = $r->validate(['sort'=>'required|integer|min:0|max:9999']);
    $catalog->products()->updateExistingPivot($product->id, ['sort'=>$data['sort']]);
    return back()->with('ok','Urutan disimpan.');
  }

  public function detach(Catalog $catalog, DigiflazzProduct $product)
  {
    $catalog->products()->detach($product->id);
    return back()->with('ok','Produk dihapus dari katalog.');
  }
}
