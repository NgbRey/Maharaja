@extends('admin.layouts.master')
@section('title','Banners'); @section('page','Banners')
@section('content')
@include('admin.partials._flash')

<div class="mb-4 flex justify-between items-center">
  <h2 class="text-xl font-semibold">Daftar Banner</h2>
  <a href="{{ route('admin.banners.create') }}" class="px-3 py-2 rounded bg-[#4a4a6a] hover:bg-[#6a6a8a]">Tambah</a>
</div>

<div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
@forelse($banners as $b)
  <div class="rounded-2xl bg-[#141b2d] overflow-hidden">
    <img src="{{ asset('storage/'.$b->image_path) }}" class="w-full h-40 object-cover" alt="">
    <div class="p-3">
      <div class="font-semibold">{{ $b->title ?? '—' }}</div>
      <div class="text-xs text-gray-400">Aktif: {{ $b->is_active ? 'Ya' : 'Tidak' }} • Sort: {{ $b->sort }}</div>
      <div class="mt-2 flex gap-2">
        <a href="{{ route('admin.banners.edit',$b) }}" class="px-2 py-1 rounded bg-blue-600/70">Edit</a>
        <form method="POST" action="{{ route('admin.banners.destroy',$b) }}" onsubmit="return confirm('Hapus banner?')">
          @csrf @method('DELETE')
          <button class="px-2 py-1 rounded bg-rose-600/70">Hapus</button>
        </form>
      </div>
    </div>
  </div>
@empty
  <div class="text-gray-400">Belum ada banner.</div>
@endforelse
</div>

<div class="mt-4">{{ $banners->links() }}</div>
@endsection
