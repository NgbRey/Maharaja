@props(['title','desc'=>null])

<header class="rounded-2xl bg-gradient-to-r from-[#1b2340] to-[#202744] p-6 ring-1 ring-white/10 shadow">
  <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
    <span class="inline-block w-1.5 h-6 bg-[var(--accent)] align-middle mr-3 rounded"></span>
    {{ $title }}
  </h1>
  @if($desc)
    <p class="text-gray-300 mt-2">{{ $desc }}</p>
  @endif
</header>
