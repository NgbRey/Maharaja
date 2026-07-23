@if(session('ok'))
  <div class="mb-4 px-4 py-3 rounded bg-emerald-600/20 text-emerald-300">{{ session('ok') }}</div>
@endif
@error('*')
  <div class="mb-4 px-4 py-3 rounded bg-rose-600/20 text-rose-300">{{ $message }}</div>
@enderror
