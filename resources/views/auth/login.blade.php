<x-guest-layout title="Masuk">
  @if (session('status'))
    <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-600/20 text-emerald-300">{{ session('status') }}</div>
  @endif

  <div class="rounded-2xl bg-[#141b2d] p-6 shadow-xl border border-white/5">
    <div class="mb-6">
      <h1 class="text-2xl font-bold">Masuk</h1>
      <p class="text-gray-400 text-sm">Akses akunmu untuk melanjutkan transaksi.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
      @csrf

      {{-- Email --}}
      <div>
        <label for="email" class="block text-sm mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full px-3 py-2 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
        @error('email')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      {{-- Password --}}
      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm mb-1">Password</label>
          @if (Route::has('password.request'))
            <a class="text-xs text-gray-300 hover:text-white" href="{{ route('password.request') }}">Lupa password?</a>
          @endif
        </div>
        <input id="password" type="password" name="password" required
               class="w-full px-3 py-2 rounded-xl bg-[#1a2138] text-white placeholder-gray-400 ring-1 ring-white/10 focus:outline-none focus:ring-2 focus:ring-[#ff5530]">
        @error('password')<div class="text-rose-300 text-sm mt-1">{{ $message }}</div>@enderror
      </div>

      {{-- Remember --}}
      <div class="flex items-center justify-between text-sm">
        <label class="inline-flex items-center gap-2 select-none">
          <input type="checkbox" name="remember" class="rounded bg-[#1a2138] border-white/10">
          <span>Ingat saya</span>
        </label>
      </div>

      {{-- Submit --}}
      <button type="submit"
              class="w-full py-2.5 rounded-xl bg-[#ff5530] hover:bg-[#ff6a4a] transition font-semibold">
        Masuk
      </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-300">
      Belum punya akun?
      <a href="{{ route('register') }}" class="font-semibold text-white hover:underline">Daftar</a>
    </div>
  </div>

  {{-- link kembali ke beranda --}}
  <div class="mt-6 text-center">
    <a href="{{ route('public.home') }}" class="text-sm text-gray-300 hover:text-white">← Kembali ke Beranda</a>
  </div>
</x-guest-layout>
