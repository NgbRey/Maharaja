<!-- resources/views/admin/layouts/sidebar.blade.php -->
<aside class="fixed inset-y-0 w-64 bg-[#19203a] text-white z-40 shadow-lg">
  <div class="px-4 py-5 border-b border-white/10 flex items-center gap-3">
    <span class="font-bold tracking-wide">Maharaja <span class="text-[var(--accent)]">Admin</span></span>
  </div>

  <nav class="px-3 py-4 space-y-1">
    @php
      // URL & pola route yang dianggap aktif untuk tiap item
      $items = [
        [
          'label' => 'Dashboard',
          'url'   => route('admin.dashboard'),
          'is'    => ['admin.dashboard'],
        ],
        [
          'label' => 'Catalog',
          'url'   => route('admin.catalog.index'),
          'is'    => ['admin.catalog.*'],
        ],
        [
          'label' => 'Set Produk',
          'url'   => route('admin.setProduk.index'),
          'is'    => ['admin.setProduk.*'],
        ],
        [
          'label' => 'Banner',
          'url'   => route('admin.banners.index'),
          'is'    => ['admin.banners.*'],
        ],
      ];
    @endphp

    @foreach ($items as $it)
      @php $active = request()->routeIs(...$it['is']); @endphp
      <a href="{{ $it['url'] }}" class="sidebar-link {{ $active ? 'active' : '' }}">
        {{ $it['label'] }}
      </a>
    @endforeach
  </nav>
</aside>
