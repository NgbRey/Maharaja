@extends('layouts.master')

@section('title', 'Maharaja Store - Provider Topup Terganteng Seantero Dimensi')

@section('content')

{{-- =================== BANNER =================== --}}
<section class="mt-2">
  <div class="ar-21-9 card overflow-hidden hero-banner" id="banner-slider">
    <div class="ar-content">
      <div class="flex h-full transition-transform duration-700 ease-in-out will-change-transform" id="slides">
        @foreach($banners as $b)
          @php $src = asset('storage/'.$b->image_path); @endphp
          @if($b->link_url)
            <a href="{{ $b->link_url }}" target="_blank" class="w-full flex-shrink-0 h-full">
              <img src="{{ $src }}" alt="{{ $b->title }}" class="w-full h-full object-cover">
            </a>
          @else
            <img src="{{ $src }}" alt="{{ $b->title }}" class="w-full h-full object-cover flex-shrink-0">
          @endif
        @endforeach
      </div>

      @if(($banners ?? collect())->count() > 1)
        <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 z-10 bg-black/40 hover:bg-black/70 text-white p-2 rounded-full">&#10094;</button>
        <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 z-10 bg-black/40 hover:bg-black/70 text-white p-2 rounded-full">&#10095;</button>

        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 z-10 flex gap-2" id="indicators">
          @foreach($banners as $i => $b)
            <span class="w-2.5 h-2.5 bg-white/50 rounded-full cursor-pointer" data-i="{{ $i }}"></span>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>

{{-- =================== CATALOG STACK (lebih lega) =================== --}}
<section class="catalog-wrap">

  {{-- === GAMES === --}}
  <div id="games" class="catalog-section">
    <h2 class="catalog-title text-lg font-semibold text-white">
      <span class="text-[var(--accent)]">Games</span>
      @if(($games ?? collect())->count())
        <span class="text-sm text-gray-400">({{ count($games) }})</span>
      @endif
    </h2>
    <div class="section">
    <div class="catalog-grid">
      @forelse($games as $g)
        <a href="{{ url('/produk/games/'.$g->slug) }}" class="product-card">
          <img src="{{ $g->thumb }}" alt="{{ $g->name }}" class="product-thumb">
          <div class="product-label">
            <div class="product-title">{{ $g->name }}</div>
            <div class="product-dev">{{ $g->developer ?? '—' }}</div>
          </div>
        </a>
      @empty
        <div class="text-gray-400">Belum ada data.</div>
      @endforelse
      </div>
    </div>
  </div>

  {{-- === PULSA & DATA === --}}
  <div id="pulsa" class="catalog-section">
    <h2 class="catalog-title text-lg font-semibold text-white">
      <span class="text-[var(--accent)]">Pulsa &amp; Data</span>
      @if(($pulsa ?? collect())->count())
        <span class="text-sm text-gray-400">({{ count($pulsa) }})</span>
      @endif
    </h2>

    <div class="section">
    <div class="catalog-grid">
      @forelse($pulsa as $p)
        <a href="{{ url('/produk/'.$p->slug) }}" class="product-card">
          <img src="{{ $p->thumb }}" alt="{{ $p->name }}" class="product-thumb">
          <div class="product-label">
            <div class="product-title">{{ $p->name }}</div>
            <div class="product-dev">{{ $p->developer ?? '—' }}</div>
          </div>
        </a>
      @empty
        <div class="text-gray-400">Belum ada data.</div>
      @endforelse
      </div>
    </div>
  </div>

  {{-- === LAINNYA === --}}
  <div id="lainnya" class="catalog-section">
    <h2 class="catalog-title text-lg font-semibold text-white">
      <span class="text-[var(--accent)]">Lainnya</span>
      @if(($lainnya ?? collect())->count())
        <span class="text-sm text-gray-400">({{ count($lainnya) }})</span>
      @endif
    </h2>

    <div class="section">
    <div class="catalog-grid">
      @forelse($lainnya as $l)
        <a href="{{ url('/produk/'.$l->slug) }}" class="product-card">
          <img src="{{ $l->thumb }}" alt="{{ $l->name }}" class="product-thumb">
          <div class="product-label">
            <div class="product-title">{{ $l->name }}</div>
            <div class="product-dev">{{ $l->developer ?? '—' }}</div>
          </div>
        </a>
      @empty
        <div class="text-gray-400">Belum ada data.</div>
      @endforelse
      </div>
    </div>
  </div>

</section>

@endsection
