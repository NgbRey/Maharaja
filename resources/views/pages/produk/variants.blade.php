<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
  @forelse($products as $v)
    <label class="radio-card p-3 cursor-pointer">
      <input type="radio" name="product_code" value="{{ $v->code }}" class="hidden" required>
      <div class="radio-ui rounded-lg p-3 flex items-center justify-between bg-dongker/50">
        <div>
          <div class="font-semibold">{{ $v->name }}</div>
          @if(!empty($v->note)) <div class="text-xs opacity-70 mt-1">{{ $v->note }}</div> @endif
        </div>
        <div class="font-bold">Rp {{ number_format($v->price,0,',','.') }}</div>
      </div>
    </label>
  @empty
    <div class="helper col-span-full">Produk belum tersedia di halaman ini.</div>
  @endforelse
</div>
