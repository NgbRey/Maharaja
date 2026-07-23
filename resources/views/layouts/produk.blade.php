@extends('layouts.master')

@section('title', $game->name ?? 'Produk')

@section('content')
{{-- Header: banner + identitas --}}
<section class="space-y-4">
  <div class="hero-banner overflow-hidden">
    <img src="{{ $game->banner_url ?? asset('images/default-game-banner.jpg') }}"
         alt="{{ $game->name ?? 'Produk' }}" class="w-full h-full object-cover">
  </div>

  <div class="flex items-center gap-4">
    <img src="{{ $game->icon_url ?? asset('images/default-game-icon.png') }}"
         class="w-14 h-14 rounded-2xl ring-1 ring-white/10 object-cover" alt="{{ $game->name ?? 'Produk' }}">
    <div>
      <div class="flex items-center gap-2">
        <h1 class="text-xl md:text-2xl font-bold text-white">{{ $game->name ?? 'Produk' }}</h1>
        @if(!empty($game->developer))
          <span class="badge-accent">{{ $game->developer }}</span>
        @endif
      </div>
      @if(!empty($game->subtitle))
        <p class="helper mt-1">{{ $game->subtitle }}</p>
      @endif
    </div>
  </div>
</section>

{{-- Form Topup ringkas (bisa kamu lengkapi nanti) --}}
<form method="POST" {{--action="{{ route('checkout.create') }}"--}} class="mt-6 grid md:grid-cols-3 gap-4">
  @csrf
  <input type="hidden" name="game_id" value="{{ $game->id }}">

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
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @forelse($variants as $v)
          <label class="radio-card p-3 cursor-pointer">
            <input type="radio" name="product_code" value="{{ $v['code'] }}" class="hidden" required>
            <div class="radio-ui rounded-lg p-2 flex items-center justify-between">
              <div>
                <div class="font-semibold text-white">{{ $v['name'] }}</div>
                @if(!empty($v['note'])) <div class="helper mt-1">{{ $v['note'] }}</div> @endif
              </div>
              <div class="text-white font-bold">Rp {{ number_format($v['price'] ?? 0,0,',','.') }}</div>
            </div>
          </label>
        @empty
          <div class="helper">Produk belum tersedia.</div>
        @endforelse
      </div>
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
            <div class="font-semibold text-white">Midtrans</div>
            <img src="{{ asset('images/payments/midtrans.svg') }}" class="h-6 opacity-90" alt="Midtrans">
          </div>
        </label>
        <label class="radio-card p-3 cursor-pointer">
          <input type="radio" name="payment_method" value="tripay" class="hidden" required>
          <div class="radio-ui rounded-lg p-2 flex items-center justify-between">
            <div class="font-semibold text-white">Tripay</div>
            <img src="{{ asset('images/payments/tripay.svg') }}" class="h-6 opacity-90" alt="Tripay">
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

<script>
document.addEventListener('DOMContentLoaded', () => {
  const radios = document.querySelectorAll('input[name="product_code"]');
  const qtyInput = document.querySelector('input[name="quantity"]');
  const sumName = document.getElementById('summary-product');
  const sumPrice = document.getElementById('summary-price');
  const sumQty = document.getElementById('summary-qty');
  const sumTotal = document.getElementById('summary-total');

  let current = { name:'—', price:0 };
  const fmt = n => 'Rp ' + (n||0).toLocaleString('id-ID');
  const refresh = () => {
    const q = parseInt(qtyInput.value||1,10);
    sumName.textContent = current.name;
    sumPrice.textContent = fmt(current.price);
    sumQty.textContent = q;
    sumTotal.textContent = fmt((current.price||0)*q);
  };

  radios.forEach(r => r.addEventListener('change', () => {
    const wrap = r.closest('.radio-card');
    current.name  = wrap.querySelector('.font-semibold').textContent.trim();
    current.price = parseInt((wrap.querySelector('.text-white.font-bold').textContent||'').replace(/[^\d]/g,''),10) || 0;
    refresh();
  }));
  qtyInput.addEventListener('input', refresh);
  refresh();
});
</script>
@endsection
