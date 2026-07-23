@extends('layouts.master')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  <!-- Header -->
  <header class="rounded-2xl bg-gradient-to-r from-[#1b2340] to-[#202744] p-6 ring-1 ring-white/10 shadow">
    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
      <span class="inline-block w-1.5 h-6 bg-[var(--accent)] align-middle mr-3 rounded"></span>
      Syarat & Ketentuan
    </h1>
    <p class="text-gray-300 mt-2">Dengan menggunakan layanan Maharaja Store, Anda menyetujui ketentuan berikut.</p>
  </header>

  <!-- Cards -->
  <div class="grid md:grid-cols-2 gap-6">
    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">1. Layanan</h2>
      <p class="text-gray-300 leading-relaxed">
        Kami menyediakan layanan top up game, pulsa, dan produk digital sesuai informasi yang tercantum pada situs.
      </p>
    </section>

    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">2. Pembayaran</h2>
      <ul class="text-gray-300 space-y-2 list-disc list-inside">
        <li>Transaksi menggunakan metode resmi yang tersedia.</li>
        <li>Pembayaran penuh wajib diselesaikan sebelum pesanan diproses.</li>
      </ul>
    </section>

    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">3. Proses & Waktu</h2>
      <p class="text-gray-300">Rata-rata 1–5 menit. Dapat lebih lama saat maintenance/gangguan provider.</p>
    </section>

    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">4. Refund</h2>
      <p class="text-gray-300">Refund hanya untuk pesanan gagal & saldo tidak terpotong di provider.</p>
    </section>

    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">5. Akun & Data</h2>
      <p class="text-gray-300">Pastikan ID/Server/Nickname benar. Kesalahan input bukan tanggung jawab kami.</p>
    </section>

    <section class="card p-6 bg-[#151b33]/80">
      <h2 class="text-lg font-semibold text-white/90 mb-3">6. Perubahan</h2>
      <p class="text-gray-300">Ketentuan dapat berubah sewaktu-waktu tanpa pemberitahuan.</p>
    </section>
  </div>

  <div class="rounded-2xl border border-white/10 p-5 bg-[#10162b]/80">
    <p class="text-sm text-gray-400">Terakhir diperbarui: {{ now()->format('d M Y') }}</p>
  </div>
</div>
@endsection
