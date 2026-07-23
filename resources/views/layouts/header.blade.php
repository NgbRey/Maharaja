<!-- Sidebar (slide in/out on mobile) -->
<aside
    class="fixed top-0 left-0 h-screen w-64 bg-[#19203a] shadow-lg flex flex-col transform transition-transform duration-300 z-50 lg:translate-x-0"
    :class="{ '-translate-x-full': !open }"
    aria-hidden="true"
>
    <!-- Mobile top (logo + close) -->
    <div class="relative p-4 flex items-center justify-between lg:hidden">
        <img src="{{ asset('MaharajaLogoww.png') }}" alt="logo">

        <button @click="open = false"
        class="absolute right-4 top-4 text-gray-300 p-2 rounded-md focus:outline-none hover:bg-[#ffffff1a] transition"
        aria-label="Tutup menu">
            
        </button>
    </div>

    <!-- Desktop logo -->
    <div class="p-6 hidden lg:flex justify-center">
        <img src="{{ asset('MaharajaLogoww.png') }}" alt="logo">
    </div>

    <!-- Navigasi -->
    @php
    $items = [
    ['label'=>'Beranda','url'=>route('public.home'),'is'=>['public.home'],'match'=>['/']],
    ['label'=>'Cek Pesanan','url'=>route('cek.pesanan'),'is'=>['cek.pesanan']],
    ['label'=>'Daftar Harga','url'=>route('daftar.harga'),'is'=>['daftar.harga']],
    ['label'=>'Panduan','url'=>route('panduan'),'is'=>['panduan']],
    ['label'=>'Kontak Kami','url'=>route('kontak'),'is'=>['kontak']],
    ['label'=>'Pertanyaan Umum','url'=>route('faq'),'is'=>['faq']],
    ['label'=>'Syarat & Ketentuan','url'=>route('snk'),'is'=>['snk']],
    ];
    @endphp

  <nav class="flex-1  space-y-1">
    @foreach ($items as $it)
      @php
        $byName = !empty($it['is']) && request()->routeIs(...$it['is']);
        $byPath = !empty($it['match'] ?? null) && collect($it['match'])->contains(fn($p)=>request()->is(ltrim($p,'/')));
        $active = $byName || $byPath;
      @endphp
      
      <a href="{{ $it['url'] }}" class="sidebar-link {{ $active ? 'active' : '' }}" @if($active) aria-current="page" @endif>
      {{ $it['label'] }}
      </a>
    @endforeach
  </nav>

    <!-- Footer di dalam sidebar -->
    <div class="p-4">
        <div class="flex justify-center gap-4 mb-3">
            <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-youtube"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-telegram"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-tiktok"></i></a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p class="text-xs text-center text-gray-500">
            &copy; {{ date('Y') }} Maharaja Store. All rights reserved.
        </p>
    </div>
</aside>

<!-- Overlay (tutup jika klik area diluar sidebar). Hanya tampil di mobile -->
<div
    x-show="open"
    x-cloak
    x-transition.opacity
    class="fixed inset-0 bg-black/50 z-40 lg:hidden"
    @click="open = false"
></div>

<!-- Navbar atas -->
<header class="bg-dongker  p-3 flex items-center justify-between sticky top-0 z-30 lg:ml-64">
    <!-- Tombol Hamburger (mobile) -->
    <button @click="open = !open" class="lg:hidden mr-4 text-gray-300 focus:outline-none" aria-label="Buka menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Search Box -->
    <div class="flex items-center flex-1 ml-3 max-w-md">
        <input type="text" placeholder="Cari game kamu..."
               class="w-full px-4 py-2 rounded-full bg-[#4a4a6a] text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-[#ff5530] transition-all duration-300">
    </div>

    <!-- Icon Profile/Login -->
    <div class="ml-4 relative" x-data="{ open: false }">
  @auth
    <button @click="open = !open"
      class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#4a4a6a] hover:bg-[#6a6a8a] transition focus:outline-none">
      <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
           alt="{{ Auth::user()->name }}"
           class="w-9 h-9 rounded-full object-cover">
    </button>

    <!-- Popup dropdown -->
    <div x-show="open" @click.away="open = false"
         class="absolute right-0 mt-2 w-56 bg-[#19203a] border border-white/10 rounded-xl shadow-lg overflow-hidden z-50">
      <div class="p-4 text-center">
        <img src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
             class="w-16 h-16 mx-auto rounded-full border-2 border-[var(--accent)] object-cover">
        <h3 class="mt-2 text-white font-semibold">{{ Auth::user()->name }}</h3>
      </div>
      <div class="border-t border-white/10">
        <a  href="{{ route('profile.edit') }}"
           class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/10 hover:text-white">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
                  class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-white/10 hover:text-white">
            Logout
          </button>
        </form>
      </div>
    </div>
  @else
    <a href="{{ route('profile.edit') }}"
       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#4a4a6a] hover:bg-[#6a6a8a] transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A9.004 9.004 0 0112 15c2.485 0 4.735.997 6.364 2.617M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
      </svg>
    </a>
  @endauth
</div>

</header>
