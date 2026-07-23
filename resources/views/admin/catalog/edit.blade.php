@extends('admin.layouts.master')
@section('title','Edit Kartu')
@section('page','Edit Kartu')

@section('content')
@include('admin.partials._flash')

<form method="POST"
      action="{{ route('admin.catalog.update', $item) }}"
      enctype="multipart/form-data"
      class="space-y-4">
  @csrf
  @method('PUT')

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm mb-1">Kategori</label>
      <select name="category" class="w-full px-3 py-2 rounded bg-[#1a2138]">
        <option value="games"   @selected(old('category', $item->category)==='games')>Games</option>
        <option value="pulsa"   @selected(old('category', $item->category)==='pulsa')>Pulsa & Data</option>
        <option value="lainnya" @selected(old('category', $item->category)==='lainnya')>Lainnya</option>
      </select>
      @error('category')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="block text-sm mb-1">Urutan (sort)</label>
      <input type="number" name="sort" value="{{ old('sort', $item->sort) }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
      @error('sort')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
    </div>
  </div>

  <div>
    <label class="block text-sm mb-1">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name', $item->name) }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
    @error('name')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm mb-1">Developer (opsional)</label>
    <input type="text" name="developer" value="{{ old('developer', $item->developer) }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
    @error('developer')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm mb-1">Thumbnail (jpg/png/webp, ≤3MB)</label>
    @if($item->thumbnail_path)
      <div class="mb-2">
        <span class="text-xs text-gray-400">Thumbnail saat ini:</span>
        <img src="{{ $item->thumb }}" alt="Thumbnail" class="mt-1 w-28 h-28 rounded object-cover ring-1 ring-white/10">
      </div>
    @endif
    <input type="file" name="image" class="block">
    @error('image')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>

  <label class="inline-flex items-center gap-2">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
    <span>Aktif</span>
  </label>

  <div class="flex items-center gap-2 pt-2">
    <button class="px-4 py-2 rounded bg-emerald-600/70 hover:bg-emerald-600">Update</button>
    <a href="{{ route('admin.catalog.index') }}" class="px-4 py-2 rounded bg-[#4a4a6a] hover:bg-[#6a6a8a]">Kembali</a>
  </div>
</form>
@endsection
