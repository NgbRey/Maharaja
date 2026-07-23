<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title','Admin • Maharaja')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ open: true }" class="bg-dongker text-white font-sans">
  @include('admin.layouts.sidebar')
  <div class="lg:ml-64 min-h-screen">
    <header class="bg-dongker/80 backdrop-blur sticky top-0 z-30 px-4 py-3 flex items-center justify-between">
      <button class="lg:hidden" @click="open=!open">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <h1 class="font-semibold">@yield('page','Dashboard')</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="px-3 py-1.5 rounded bg-[#4a4a6a] hover:bg-[#6a6a8a] text-sm">Logout</button>
      </form>
    </header>
    <main class="p-6">
      @yield('content')
    </main>
  </div>
</body>
</html>
