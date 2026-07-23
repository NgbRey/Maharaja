<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Http\Requests\Admin\BannerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index() {
        $banners = Banner::orderBy('sort')->latest()->paginate(12);
        return view('admin.banners.index', compact('banners'));
    }

    public function create() { return view('admin.banners.create'); }

    public function store(BannerRequest $r) {
        $data = $r->validated();
        if($r->hasFile('image')){
            $data['image_path'] = $r->file('image')->store('banners','public');
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('ok','Banner dibuat.');
    }

    public function edit(Banner $banner){ return view('admin.banners.edit', compact('banner')); }

    public function update(BannerRequest $r, Banner $banner){
        $data = $r->validated();
        if($r->hasFile('image')){
            if($banner->image_path) Storage::disk('public')->delete($banner->image_path);
            $data['image_path'] = $r->file('image')->store('banners','public');
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('ok','Banner diupdate.');
    }

    public function destroy(Banner $banner){
        if($banner->image_path) Storage::disk('public')->delete($banner->image_path);
        $banner->delete();
        return back()->with('ok','Banner dihapus.');
    }
}
