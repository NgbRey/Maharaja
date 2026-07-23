<section>
  <header class="mb-4">
    <p class="helper">Perbarui informasi profil dan alamat email-mu.</p>
  </header>

  <form method="post" action="{{ route('profile.update') }}" class="space-y-4" enctype="multipart/form-data">
    @csrf
    @method('patch')

    {{-- Foto profil (opsional, jika pakai profile photo feature) --}}
    {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos() ?? false)
      <div class="flex items-center gap-4">
        <img class="w-16 h-16 rounded-full object-cover border-2 border-[var(--accent)]"
             src="{{ Auth::user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
             alt="{{ Auth::user()->name }}">
        <div>
          <label class="helper">Ganti Foto</label>
          <input class="input" type="file" name="photo" accept="image/*">
        </div>
      </div>
    @endif --}}

    <div>
      <label class="helper">Nama</label>
      <input class="input" id="name" name="name" type="text" required autofocus
             autocomplete="name" value="{{ old('name', Auth::user()->name) }}">
      @error('name') <div class="helper text-red-300 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="helper">Email</label>
      <input class="input" id="email" name="email" type="email" required
             value="{{ old('email', Auth::user()->email) }}">
      @error('email') <div class="helper text-red-300 mt-1">{{ $message }}</div> @enderror
    </div>

    @if (session('status') === 'profile-updated')
      <p class="helper text-green-300">Profil berhasil diperbarui.</p>
    @endif

    <div class="pt-2">
      <button class="btn-accent" type="submit">Simpan</button>
    </div>
  </form>
</section>
