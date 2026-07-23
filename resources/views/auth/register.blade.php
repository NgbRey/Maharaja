{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout title="Daftar">
  <div class="rounded-2xl bg-[#141b2d] p-6 shadow-xl border border-white/5">
    <div class="mb-6">
      <h1 class="text-2xl font-bold">Daftar Akun</h1>
      <p class="text-gray-400 text-sm">Buat akun untuk transaksi yang lebih cepat & riwayat tersimpan.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
      @csrf

      {{-- Nama --}}
      <div>
        <label for="name" class="block text-sm mb-1">Nama</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
               class="w-full px-3 py-2 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
        @error('name')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm mb-1">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required
               class="w-full px-3 py-2 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
        @error('email')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-sm mb-1">Password</label>
        <div class="relative">
          <input id="password" name="password" type="password" required
                 class="w-full px-3 py-2 pr-10 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
          <button type="button" class="absolute inset-y-0 right-2 my-auto text-gray-400 hover:text-gray-200"
                  onclick="const i=document.getElementById('password'); i.type=i.type==='password'?'text':'password'">👁️</button>
        </div>
        @error('password')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
        <p class="text-xs text-gray-400 mt-1">Minimal 8 karakter. Gunakan kombinasi huruf, angka, dan simbol.</p>
      </div>

      {{-- Konfirmasi Password --}}
      <div>
        <label for="password_confirmation" class="block text-sm mb-1">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required
               class="w-full px-3 py-2 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
      </div>

      {{-- Submit --}}
      <button type="submit"
              class="w-full py-2.5 rounded-xl bg-[#ff5530] hover:bg-[#ff6a4a] transition font-semibold">
        Buat Akun
      </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-300">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="font-semibold text-white hover:underline">Masuk</a>
    </div>
  </div>

  {{-- link kembali ke beranda --}}
  <div class="mt-6 text-center">
    <a href="{{ route('public.home') }}" class="text-sm text-gray-300 hover:text-white">← Kembali ke Beranda</a>
  </div>
</x-guest-layout>
