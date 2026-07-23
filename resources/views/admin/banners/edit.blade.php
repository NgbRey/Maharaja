@extends('admin.layouts.master')
@section('title','Tambah Banner'); @section('page','Tambah Banner')
@section('content')
@include('admin.partials._flash')

<form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div>
    <label class="block text-sm mb-1">Judul (opsional)</label>
    <input type="text" name="title" value="{{ old('title') }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
  </div>
  <div>
    <label class="block text-sm mb-1">Gambar (jpg/png/webp)</label>
    <input type="file" name="image" required>
    @error('image')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
  </div>
  <div>
    <label class="block text-sm mb-1">Link (opsional)</label>
    <input type="url" name="link_url" value="{{ old('link_url') }}" class="w-full px-3 py-2 rounded bg-[#1a2138]">
  </div>
  <div class="flex items-center gap-6">
    <label class="inline-flex items-center gap-2">
      <input type="checkbox" name="is_active" value="1" checked>
      <span>Aktif</span>
    </label>
    <div>
      <label class="block text-sm mb-1">Sort</label>
      <input type="number" name="sort" value="{{ old('sort',0) }}" class="px-3 py-2 rounded bg-[#1a2138]">
    </div>
  </div>
  <button class="px-4 py-2 rounded bg-emerald-600/70 hover:bg-emerald-600">Simpan</button>
</form>
@endsection
