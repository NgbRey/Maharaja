@extends('layouts.master')

@section('title', $pageTitle)

@section('content')
<section class="space-y-6">
  {{-- Banner tetap pakai banner umum kamu --}}
  <div class="hero-banner overflow-hidden rounded-2xl">
    <img src="{{ asset('images/default-game-banner.jpg') }}" alt="{{ $pageTitle }}" class="w-full h-48 object-cover">
  </div>

  <h1 class="text-xl font-bold">{{ $pageTitle }}</h1>

  <form method="POST" action="{{ route('checkout.create') }}" class="grid lg:grid-cols-3 gap-4">
    @csrf
    <input type="hidden" name="section" value="{{ $section }}">
    <input type="hidden" name="slug" value="{{ $slug }}">

    <div class="lg:col-span-2 space-y-6">
      <div class="section">
        <h2 class="font-semibold mb-3">Nominal Topup</h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
          @forelse($products as $v)
            <label class="radio-card p-3 cursor-pointer">
              <input type="radio" name="product_code" value="{{ $v->code }}" class="hidden" required>
              <div class="radio-ui rounded-lg p-3 flex items-center justify-between bg-dongker/50">
                <div>
                  <div class="font-semibold">{{ $v->name }}</div>
                  @if(!empty($v->note)) <div class="text-xs opacity-70 mt-1">{{ $v->note }}</div> @endif
                </div>
                <div class="font-bold">Rp {{ number_format($v->price,0,',','.') }}</div>
              </div>
            </label>
          @empty
            <div class="helper">Produk belum tersedia di halaman ini.</div>
          @endforelse
        </div>
      </div>

      {{-- ... tambahkan section/form lain sesuai layout kamu ... --}}
    </div>

    <aside class="lg:col-span-1 space-y-4">
      {{-- ringkasan / tombol checkout --}}
      <button class="w-full py-3 rounded-2xl bg-[#ff5530] font-semibold">Checkout</button>
    </aside>
  </form>
</section>
@endsection
