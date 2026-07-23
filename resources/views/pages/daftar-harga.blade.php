@extends('layouts.master')
@section('title','Daftar Harga')
@section('content')
<x-section-header title="Pricelist" desc="Maharaja Store menyediakan semua produk favoritmu." />

<form method="get" class="grid md:grid-cols-4 gap-3 mt-4">
  <input class="input" type="text" name="s" value="{{ request('s') }}" placeholder="Cari produk…">
  <select class="input" name="brand">
    <option value="">— Semua Brand —</option>
    @foreach($brands as $b)
      <option value="{{ $b }}" @selected(request('brand')==$b)>{{ $b }}</option>
    @endforeach
  </select>
  <select class="input" name="category">
    <option value="">— Semua Kategori —</option>
    @foreach($categories as $c)
      <option value="{{ $c }}" @selected(request('category')==$c)>{{ $c }}</option>
    @endforeach
  </select>
  <button class="btn btn-primary">Cari</button>
</form>

<div class="mt-6 grid md:grid-cols-2 lg:grid-cols-3 gap-4">
  @foreach($products as $p)
    <div class="card p-4 bg-[#151b33]/80 ring-1 ring-white/10">
      <div class="flex items-baseline justify-between">
        <div>
          <div class="text-white font-semibold">{{ $p->product_name }}</div>
          <div class="text-xs text-gray-400">{{ $p->brand }} • {{ $p->category }}</div>
        </div>
        <div class="text-right">
          <div class="text-white font-bold">Rp {{ number_format($p->price,0,',','.') }}</div>
          @unless($p->unlimited_stock)
            <div class="text-xs text-gray-400">Stok: {{ $p->stock ?? '-' }}</div>
          @endunless
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="mt-6">
  {{ $products->withQueryString()->links() }}
</div>
@endsection
