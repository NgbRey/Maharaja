@extends('admin.layouts.master')

@section('title', 'Catalog Mapping')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold">Catalog</h1>

    {{-- Filter section + slug --}}
    <form method="GET" class="flex flex-wrap items-end gap-3">
        <div>
            <label class="block text-sm mb-1">Section</label>
            <select name="section" class="bg-dongker/60 rounded p-2" onchange="this.form.submit()">
                @foreach (['games','pulsa','lainnya'] as $s)
                    <option value="{{ $s }}" @selected($section===$s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>

  <div>
    <label class="block text-sm mb-1">Slug Halaman (sesuai nama file)</label>
    <select name="slug" class="bg-dongker/60 rounded p-2" onchange="this.form.submit()">
      @foreach ($availableSlugs as $s)
        <option value="{{ $s }}" @selected($slug===$s)>{{ $s }}</option>
      @endforeach
    </select>
  </div>

  <div>
    <label class="block text-sm mb-1">Filter Brand (opsional)</label>
    <input type="text" name="brand" value="{{ request('brand') }}" class="bg-dongker/60 rounded p-2" placeholder="contoh: Mobile Legends">
  </div>

  <button class="px-4 py-2 rounded bg-[#ff5530]">Terapkan</button>
</form>

    {{-- Tambah mapping --}}
    <form method="POST" action="{{ route('admin.setProduk.store') }}" class="grid md:grid-cols-4 gap-3 bg-dongker/50 p-4 rounded-2xl">
        @csrf
        <input type="hidden" name="section" value="{{ $section }}">
        <input type="hidden" name="slug" value="{{ $slug }}">

        <div class="md:col-span-2">
            <label class="block text-sm mb-1">Pilih Produk Digiflazz</label>
            <select name="digiflazz_product_id" class="w-full bg-dongker/60 rounded p-2" required>
                @foreach ($digiflazz as $p)
                    <option value="{{ $p->id }}">
                        [{{ $p->brand }}] {{ $p->name }} ({{ $p->code }}) - Rp {{ number_format($p->price,0,',','.') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Sort Order</label>
            <input type="number" name="sort_order" class="bg-dongker/60 rounded p-2" value="0" min="0">
        </div>
        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" checked class="scale-125">
            <span>Aktif</span>
        </div>
        <div class="md:col-span-4">
            <button class="px-4 py-2 rounded bg-[#ff5530]">Tambah ke Halaman</button>
        </div>
    </form>

    {{-- Tabel mapping --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="text-left border-b border-white/10">
                <tr>
                    <th class="py-2">Order</th>
                    <th>Produk</th>
                    <th>Harga Dasar</th>
                    <th>Aktif</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mappings as $m)
                <tr class="border-b border-white/5">
                    <td class="py-2">
                        <form method="POST" action="{{ route('admin.setProduk.update',$m) }}" class="flex items-center gap-2">
                            @method('PATCH') @csrf
                            <input type="number" name="sort_order" value="{{ $m->sort_order }}" class="w-20 bg-dongker/60 rounded p-1">
                            <button class="text-xs underline">Simpan</button>
                        </form>
                    </td>
                    <td>
                        <div class="font-medium">{{ $m->digiflazzProduct->name ?? '-' }}</div>
                        <div class="text-xs opacity-60">{{ $m->digiflazzProduct->brand ?? '' }} • {{ $m->digiflazzProduct->code ?? '' }}</div>
                    </td>
                    <td>Rp {{ number_format($m->digiflazzProduct->price ?? 0,0,',','.') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.setProduk.update',$m) }}" class="flex items-center gap-2">
                            @method('PATCH') @csrf
                            <input type="hidden" name="sort_order" value="{{ $m->sort_order }}">
                            <input type="checkbox" name="is_active" value="1" @checked($m->is_active) onchange="this.form.submit()">
                        </form>
                    </td>
                    <td class="text-right">
                        <form method="POST" action="{{ route('admin.setProduk.destroy',$m) }}">
                            @method('DELETE') @csrf
                            <button class="text-red-400 hover:text-red-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-4 opacity-70">Belum ada mapping untuk halaman ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <p class="text-xs opacity-60">Halaman saat ini: <code>/produk/{{ $section }}/{{ $slug }}</code></p>
</div>
@endsection
