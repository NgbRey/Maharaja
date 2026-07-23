@extends('layouts.master')

@section('title', 'Pertanyaan Umum')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
  <!-- Header -->
  <header class="rounded-2xl bg-gradient-to-r from-[#1b2340] to-[#202744] p-6 ring-1 ring-white/10 shadow">
    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
      <span class="inline-block w-1.5 h-6 bg-[var(--accent)] align-middle mr-3 rounded"></span>
      Pertanyaan Umum (FAQ)
    </h1>
    <p class="text-gray-300 mt-2">Jawaban singkat untuk pertanyaan yang sering diajukan.</p>
  </header>

  <!-- Accordions -->
  @php
    $faqs = [
      ['q'=>'Berapa lama proses top up?',
       'a'=>'Rata-rata 1–5 menit. Bisa lebih lama jika ada gangguan dari provider/publisher.'],
      ['q'=>'Apakah harga sudah termasuk biaya?',
       'a'=>'Harga yang tertera adalah harga final, kecuali ada biaya tambahan dari metode pembayaran.'],
      ['q'=>'Salah input ID/Server, bagaimana?',
       'a'=>'Mohon maaf, kesalahan data dari pengguna bukan tanggung jawab kami. Pastikan data benar sebelum checkout.'],
      ['q'=>'Apakah ada refund?',
       'a'=>'Refund hanya jika transaksi gagal dan saldo tidak masuk. Tidak berlaku untuk salah input data.'],
      ['q'=>'Bagaimana cek status pesanan?',
       'a'=>'Buka menu “Cek Pesanan” dan masukkan ID pesanan yang Anda terima saat checkout.'],
    ];
  @endphp

  <div class="space-y-3">
    @foreach($faqs as $i=>$f)
      <details class="group rounded-xl overflow-hidden ring-1 ring-white/10 bg-[#151b33]/80">
        <summary class="cursor-pointer px-5 py-4 select-none flex items-start justify-between gap-4">
          <div class="font-medium text-white/90">{{ $f['q'] }}</div>
          <span class="transition group-open:rotate-45 text-white/70">+</span>
        </summary>
        <div class="px-5 pb-5 text-gray-300 border-t border-white/10">
          {{ $f['a'] }}
        </div>
      </details>
    @endforeach
  </div>

  <!-- Bottom CTA -->
  <div class="rounded-2xl p-5 bg-[#10162b]/80 ring-1 ring-white/10 flex flex-col md:flex-row items-center gap-4">
    <p class="flex-1 text-gray-300">Tidak menemukan jawabanmu?</p>
    <a href="{{ url('/kontak') }}" class="btn btn-primary w-full md:w-auto">Hubungi Kami</a>
  </div>
</div>
@endsection
