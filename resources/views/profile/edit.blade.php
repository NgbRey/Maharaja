@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="max-w-3xl mx-auto mt-6 space-y-6">
  {{-- Info profil --}}
  <div class="section">
    <h2 class="text-white font-semibold mb-3">Informasi Profil</h2>
    @include('profile.partials.update-profile-information-form')
  </div>

  {{-- Update password --}}
  <div class="section">
    <h2 class="text-white font-semibold mb-3">Ubah Password</h2>
    @include('profile.partials.update-password-form')
  </div>

  {{-- Hapus akun --}}
  <div class="section">
    <h2 class="text-white font-semibold mb-3">Hapus Akun</h2>
    @include('profile.partials.delete-user-form')
  </div>
</div>
@endsection
