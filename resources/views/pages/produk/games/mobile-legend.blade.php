@extends('layouts.master')

@section('title', 'Mobile Legends')

@section('content')
<section class="space-y-4">
  {{-- Hero --}}
  <div class="hero-banner overflow-hidden">
    <img src="{{ $game->banner_url ?? asset('images/default-game-banner.jpg') }}"
         alt="{{ $game->name ?? 'Produk' }}" class="w-full h-full object-cover">
  </div>

  <div class="flex items-center gap-4">
    <img src="{{ $slug->thumbnail_path ?? asset('images/default-game-icon.png') }}">
    <div>
      <h1 class="text-xl font-bold">Mobile Legends</h1>
      <p class="text-sm text-gray-400">Moonton</p>
    </div>
    </div>

  <form method="POST" {{--action="{{ route('checkout.create') }}"--}} class="mt-6 grid md:grid-cols-3 gap-4">
  @csrf
  {{-- <input type="hidden" name="game_id" value="{{ $game->id }}"> --}}

  <div class="md:col-span-2 space-y-4">
    <div class="section">
      <h2 class="text-white font-semibold mb-3">Data Akun</h2>
      <div class="grid md:grid-cols-2 gap-3">
        <div>
          <label class="helper">ID Player</label>
          <input name="account_id" required class="input" placeholder="123456789">
        </div>
        <div>
          <label class="helper">Server / Zone</label>
          <input name="server" required class="input" placeholder="1234">
        </div>
      </div>
    </div>

    <div class="section">
      <h2 class="text-white font-semibold mb-3">Nominal Topup</h2>
        @include('pages.produk.variants')
    </div>

    <div class="section">
      <h2 class="text-white font-semibold mb-3">Jumlah Pembelian</h2>
      <div x-data="{ q: 1 }" class="flex items-center gap-3">
        <button type="button" @click="q=Math.max(1,q-1)" class="w-10 h-10 rounded-lg bg-[#202744] text-white/90">−</button>
        <input name="quantity" x-model.number="q" min="1" required class="input w-20 text-center" />
        <button type="button" @click="q++" class="w-10 h-10 rounded-lg bg-[#202744] text-white/90">+</button>
      </div>
    </div>

    <div class="section">
      <h2 class="text-white font-semibold mb-3">Pilih Pembayaran</h2>
      <div class="grid sm:grid-cols-2 gap-3">
        <label class="radio-card p-3 cursor-pointer">
          <input type="radio" name="payment_method" value="midtrans" class="hidden" required>
          <div class="radio-ui rounded-lg p-2 flex items-center justify-between">
            <div class="font-semibold text-white">QRIS</div>
            <img src="{{ asset('images/payments/midtrans.svg') }}" class="h-6 opacity-90" alt="Qris">
          </div>
        </label>
        <label class="radio-card p-3 cursor-pointer">
          <input type="radio" name="payment_method" value="tripay" class="hidden" required>
          <div class="radio-ui rounded-lg p-2 flex items-center justify-between">
            <div class="font-semibold text-white">Transfer Bank</div>
            <img src="{{ asset('images/payments/tripay.svg') }}" class="h-6 opacity-90" alt="Bank">
          </div>
        </label>
      </div>
    </div>

    <div class="section">
      <h2 class="text-white font-semibold mb-3">Kode Promo</h2>
      <input name="voucher" class="input" placeholder="Masukkan kode promo jika ada">
    </div>

    <div class="section">
      <h2 class="text-white font-semibold mb-3">Kontak</h2>
      <div class="grid md:grid-cols-2 gap-3">
        <input type="email" name="email" class="input" placeholder="nama@email.com" required>
        <input type="tel" name="whatsapp" class="input" placeholder="08xxxxxxxxxx" required>
      </div>
    </div>
  </div>

  <aside class="space-y-4">
    <div class="section">
      <h3 class="text-white font-semibold mb-3">Ringkasan</h3>
      <ul class="text-sm text-white/80 space-y-2">
        <li class="flex justify-between"><span>Produk</span><span id="summary-product">—</span></li>
        <li class="flex justify-between"><span>Harga Satuan</span><span id="summary-price">Rp 0</span></li>
        <li class="flex justify-between"><span>Qty</span><span id="summary-qty">1</span></li>
        <li class="flex justify-between border-t border-white/10 pt-2 font-bold">
          <span>Total</span><span id="summary-total">Rp 0</span>
        </li>
      </ul>
    </div>
    <button type="submit" class="btn-accent w-full">Beli Sekarang</button>
  </aside>
</form>
</section>
@endsection
