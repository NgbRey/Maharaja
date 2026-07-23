@props(['title' => $title ?? 'Masuk'])

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ $title }} • Maharaja Store</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-dongker text-white font-sans flex">
  {{-- panel kiri: brand --}}
  <aside class="hidden lg:flex w-1/2 relative overflow-hidden">
    {{-- <img src="{{ asset('images/login-illustration.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-10"> --}}
    <div class="relative z-10 w-full h-full grid place-items-center p-12">
      <div class="max-w-md">
        <div class="flex items-center gap-3 mb-6">
          <img src="{{ asset('MaharajaLogo.png') }}" class="w-16 h-16 rounded-xl" alt="Maharaja">
          <div>
            <div class="text-2xl font-bold leading-tight">Maharaja Store</div>
            <div class="text-sm text-gray-300">Tempat Topup Game Terpercaya & Otomatis</div>
          </div>
        </div>
        <div class="space-y-3 text-gray-300">
          <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#ff5530]"></span> Transaksi otomatis & cepat</div>
          <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#ff5530]"></span> Pembayaran lengkap (gateway & saldo)</div>
          <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-[#ff5530]"></span> Support 24/7 via WhatsApp</div>
        </div>
      </div>
    </div>
  </aside>

  {{-- panel kanan: form --}}
  <main class="flex-1 grid place-items-center p-6">
    <div class="w-full max-w-md">
      {{ $slot }}
      <footer class="mt-8 text-center text-xs text-gray-400">
        &copy; {{ date('Y') }} Maharaja Store. All rights reserved.
      </footer>
    </div>
  </main>
</body>
</html>
