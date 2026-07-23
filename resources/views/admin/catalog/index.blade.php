{{-- resources/views/admin/catalog/index.blade.php --}}
@extends('admin.layouts.master')
@section('title','Catalog'); @section('page','Catalog')
@section('content')
@include('admin.partials._flash')

<div class="mb-4 flex justify-between items-center">
  <h2 class="text-xl font-semibold">Kartu Katalog (Home)</h2>
  <a href="{{ route('admin.catalog.create') }}" class="px-3 py-2 rounded bg-[#4a4a6a] hover:bg-[#6a6a8a]">Tambah</a>
</div>

<div class="rounded-2xl overflow-hidden bg-[#141b2d] p-3">
  <table class="w-full">
    <thead class="text-left text-gray-400">
      <tr>
        <th class="p-2">Thumb</th>
        <th class="p-2">Nama</th>
        <th class="p-2">Kategori</th>
        <th class="p-2">Developer</th>
        <th class="p-2">Aktif</th>
        <th class="p-2">Sort</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr class="border-t border-white/5">
          <td class="p-2"><img src="{{ $it->thumb }}" class="w-12 h-12 object-cover rounded"></td>
          <td class="p-2 font-semibold">{{ $it->name }}</td>
          <td class="p-2">{{ ucfirst($it->category) }}</td>
          <td class="p-2 text-gray-300">{{ $it->developer ?? '—' }}</td>
          <td class="p-2">{{ $it->is_active ? 'Ya' : 'Tidak' }}</td>
          <td class="p-2">{{ $it->sort }}</td>
          <td class="p-2">
            <a href="{{ route('admin.catalog.edit',$it) }}" class="px-2 py-1 rounded bg-blue-600/70">Edit</a>
            <form method="POST" action="{{ route('admin.catalog.destroy',$it) }}" class="inline" onsubmit="return confirm('Hapus kartu ini?')">
              @csrf @method('DELETE')
              <button class="px-2 py-1 rounded bg-rose-600/70">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td class="p-3 text-gray-400" colspan="7">Belum ada data.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

@if($items instanceof \Illuminate\Contracts\Pagination\Paginator)
  <div class="mt-4">{{ $items->onEachSide(1)->links() }}</div>
@endif
@endsection
