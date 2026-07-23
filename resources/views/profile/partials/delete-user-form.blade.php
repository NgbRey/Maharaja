<section x-data="{ open: false }">
  <header class="mb-4">
    <p class="helper">Sekali dihapus, semua data akunmu akan hilang. Tindakan ini tidak bisa dibatalkan.</p>
  </header>

  <button type="button" @click="open = true"
          class="px-4 py-2 rounded-lg bg-red-600/80 hover:bg-red-600 text-white font-semibold">
    Hapus Akun
  </button>

  <!-- Modal konfirmasi sederhana -->
  <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60" x-cloak>
    <div class="bg-[#19203a] border border-white/10 rounded-xl p-5 w-full max-w-md">
      <h3 class="text-white font-semibold mb-2">Konfirmasi Hapus Akun</h3>
      <p class="helper mb-4">Masukkan password untuk konfirmasi penghapusan akun.</p>

      <form method="post" action="{{ route('profile.destroy') }}" class="space-y-3">
        @csrf
        @method('delete')

        <input class="input" type="password" name="password" placeholder="Password">
        @error('password') <div class="helper text-red-300">{{ $message }}</div> @enderror

        <div class="flex items-center justify-end gap-2 pt-2">
          <button type="button" @click="open = false"
                  class="px-4 py-2 rounded-lg bg-[#202744] text-white/90">Batal</button>
          <button type="submit"
                  class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold">
            Hapus
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
