<?php
// app/Http/Controllers/Admin/CatalogController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
  public function index() {
    $items = Catalog::orderBy('sort')->get();
    return view('admin/catalogs/index', compact('items'));
  }

  public function create() { return view('admin/catalogs/create'); }

  public function store(Request $r) {
    $data = $r->validate(['name'=>'required|string|max:100','slug'=>'nullable|string','sort'=>'nullable|integer']);
    $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
    $data['sort'] = $data['sort'] ?? 0;
    Catalog::create($data);
    return redirect()->route('admin.catalogs.index')->with('ok','Catalog dibuat');
  }

  public function edit(Catalog $catalog) {
    return view('admin/catalogs/edit', compact('catalog'));
  }

  public function update(Request $r, Catalog $catalog) {
    $data = $r->validate(['name'=>'required','slug'=>'required','sort'=>'nullable|integer']);
    $catalog->update($data);
    return back()->with('ok','Catalog diperbarui');
  }

  public function destroy(Catalog $catalog) {
    $catalog->delete();
    return back()->with('ok','Catalog dihapus');
  }
}
