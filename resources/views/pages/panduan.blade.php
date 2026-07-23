@extends('layouts.master')

@section('title', 'Panduan')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
  <!-- Header -->
  <header class="rounded-2xl bg-gradient-to-r from-[#1b2340] to-[#202744] p-6 ring-1 ring-white/10 shadow">
    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
      <span class="inline-block w-1.5 h-6 bg-[var(--accent)] align-middle mr-3 rounded"></span>
      Panduan Top Up
    </h1>
    <p class="text-gray-300 mt-2">Langkah cepat & aman bertransaksi di Maharaja Store.</p>
  </header>

  <!-- Steps -->
  <section class="grid lg:grid-cols-3 gap-6">
    @php
      $steps = [
        ['title'=>'Pilih Produk','desc'=>'Buka beranda lalu pilih game/produk.'],
        ['title'=>'Isi Data Akun','desc'=>'Masukkan ID, Server, Nickname dengan benar.'],
        ['title'=>'Pilih Varian','desc'=>'Tentukan nominal/produk yang tersedia.'],
        ['title'=>'Metode Bayar','desc'=>'Pilih pembayaran (Midtrans/Tripay, e-wallet, dst).'],
        ['title'=>'Konfirmasi','desc'=>'Cek detail pesanan sebelum bayar.'],
        ['title'=>'Selesaikan','desc'=>'Ikuti instruksi pembayaran & tunggu proses auto.'],
      ];
    @endphp

    @foreach($steps as $i=>$s)
      <div class="card p-6 bg-[#151b33]/80">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-9 h-9 rounded-xl bg-[var(--accent)]/10 grid place-content-center ring-1 ring-[var(--accent)]/30">
            <span class="font-bold text-[var(--accent)]">{{ $i+1 }}</span>
          </div>
          <h3 class="font-semibold text-white/90">{{ $s['title'] }}</h3>
        </div>
        <p class="text-gray-300">{{ $s['desc'] }}</p>
      </div>
    @endforeach
  </section>

  <!-- Help CTA -->
  <section class="rounded-2xl p-6 bg-[#10162b]/80 ring-1 ring-white/10 flex flex-col md:flex-row items-center gap-5">
    <div class="flex-1">
      <h4 class="text-white font-semibold">Butuh bantuan?</h4>
      <p class="text-gray-300">Tim support siap membantu setiap hari 09:00–22:00 WIB.</p>
    </div>
    <a href="https://wa.me/6281234567890?text=Halo%20Maharaja%20Store,%20saya%20butuh%20bantuan%20top%20up."
       target="_blank"
       class="btn btn-primary w-full md:w-auto">
       Chat WhatsApp
    </a>
  </section>
</div>
@endsection
