@extends('layouts.master')

@section('title', 'Kontak Kami')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
  <!-- Header -->
  <header class="rounded-2xl bg-gradient-to-r from-[#1b2340] to-[#202744] p-6 ring-1 ring-white/10 shadow">
    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
      <span class="inline-block w-1.5 h-6 bg-[var(--accent)] align-middle mr-3 rounded"></span>
      Kontak Kami
    </h1>
    <p class="text-gray-300 mt-2">Tim support siap membantu transaksi dan kendalamu.</p>
  </header>

  <!-- Info Grid -->
  <section class="grid md:grid-cols-3 gap-6">
    <div class="card p-6 bg-[#151b33]/80">
      <div class="text-sm text-gray-400">WhatsApp</div>
      <div class="mt-1 font-semibold">+62 881-081-011-223</div>
      <a href="https://wa.me/62881081011223?text=Halo%20Maharaja%20Store"
         target="_blank"
         class="btn btn-primary mt-4 w-full">Chat via WhatsApp</a>
    </div>

    <div class="card p-6 bg-[#151b33]/80">
      <div class="text-sm text-gray-400">Email</div>
      <div class="mt-1 font-semibold">atmin.maharaja@gmail.com</div>
      <a href="mailto:support@maharajastore.com" class="btn btn-muted mt-4 w-full">Kirim Email</a>
    </div>

    <div class="card p-6 bg-[#151b33]/80">
      <div class="text-sm text-gray-400">Telegram</div>
      <div class="mt-1 font-semibold">@maharajastore</div>
      <a href="https://t.me/maharajastore" target="_blank" class="btn btn-muted mt-4 w-full">Buka Telegram</a>
    </div>
  </section>

  <!-- Contact Form (optional) -->
  <section class="card p-6 bg-[#151b33]/80">
    <h2 class="text-lg font-semibold text-white/90 mb-4">Kirim Pesan</h2>
    <form class="grid md:grid-cols-2 gap-4">
      <input type="text" name="name" placeholder="Nama Lengkap" class="input">
      <input type="email" name="email" placeholder="Email" class="input">
      <div class="md:col-span-2">
        <textarea name="message" rows="4" placeholder="Tulis pesanmu di sini..." class="input"></textarea>
      </div>
      <div class="md:col-span-2 flex items-center justify-between">
        <p class="text-sm text-gray-400">Waktu respons: 5–15 menit (09:00–22:00 WIB)</p>
        <button type="button"
          onclick="window.open('https://wa.me/62881081011223?text=' + encodeURIComponent('[KONTAK] Halo Maharaja Store, saya ingin bertanya...'),'_blank')"
          class="btn btn-primary">
          Kirim via WhatsApp
        </button>
      </div>
    </form>
  </section>
</div>
@endsection
