<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Maharaja Store')</title>
    @vite('resources/css/app.css')

    {{-- Font Awesome (opsional) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    {{-- Alpine (untuk toggle sidebar) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body
    x-data="{ open: false }"
    :class="{ 'overflow-hidden': open }"
    class="bg-dongker text-white font-sans"
>
    {{-- Sidebar & Navbar --}}
    @include('layouts.header')

    {{-- Content (NOTE: margin hanya di lg ke atas) --}}
    <div class="lg:ml-64 flex flex-col min-h-screen">
        <main class="flex-1 p-6">
            @yield('content')
        </main>

        {{-- footer jika mau/digunakan di luar sidebar --}}
        {{-- @include('layouts.footer') --}}
    </div>

    @vite('resources/js/app.js')

</body>
</html>
