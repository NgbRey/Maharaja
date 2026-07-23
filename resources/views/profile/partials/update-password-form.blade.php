<section>
  <header class="mb-4">
    <p class="helper">Pastikan akunmu menggunakan password panjang dan acak agar tetap aman.</p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
      <label class="helper">Password Saat Ini</label>
      <input class="input" id="current_password" name="current_password" type="password" autocomplete="current-password">
      @error('current_password') <div class="helper text-red-300 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="helper">Password Baru</label>
      <input class="input" id="password" name="password" type="password" autocomplete="new-password">
      @error('password') <div class="helper text-red-300 mt-1">{{ $message }}</div> @enderror
    </div>

    <div>
      <label class="helper">Konfirmasi Password Baru</label>
      <input class="input" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
      @error('password_confirmation') <div class="helper text-red-300 mt-1">{{ $message }}</div> @enderror
    </div>

    @if (session('status') === 'password-updated')
      <p class="helper text-green-300">Password berhasil diperbarui.</p>
    @endif

    <div class="pt-2">
      <button class="btn-accent" type="submit">Update Password</button>
    </div>
  </form>
</section>
