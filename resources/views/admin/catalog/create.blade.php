@extends('admin.layouts.master')
@section('title','Tambah Kartu'); @section('page','Tambah Kartu')
@section('content')
@include('admin.partials._flash')

<form method="POST" action="{{ route('admin.catalog.store') }}" enctype="multipart/form-data" class="space-y-4">
  @csrf
  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm mb-1">Kategori</label>
      <select name="category" class="w-full px-3 py-2 rounded bg-[#1a2138]">
        <option value="games">Games</option>
        <option value="pulsa">Pulsa & Data</option>
        <option value="lainnya">Lainnya</option>
      </select>
    </div>
    <div>
      <label class="block text-sm mb-1">Urutan (sort)</label>
      <input type="number" name="sort" value="{{ old('sort',0) }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
    </div>
  </div>

  <div>
    <label class="block text-sm mb-1">Nama Produk</label>
    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
    @error('name')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>

  <div>
    <label class="block text-sm mb-1">Developer (opsional)</label>
    <input type="text" name="developer" value="{{ old('developer') }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
  </div>

  <div>
    <label class="block text-sm mb-1">Thumbnail (jpg/png/webp, ≤3MB)</label>
    <input type="file" name="image" required>
    @error('image')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>

  <label class="inline-flex items-center gap-2">
    <input type="checkbox" name="is_active" value="1" checked>
    <span>Aktif</span>
  </label>

  <button class="px-4 py-2 rounded bg-emerald-600/70 hover:bg-emerald-600">Simpan</button>
</form>
@endsection
