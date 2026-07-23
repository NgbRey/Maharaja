@extends('admin.layouts.master')

@section('title','Dashboard Admin')
@section('page','Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
  <div class="p-4 rounded-2xl bg-[#141b2d]">
    <div class="text-sm text-gray-400">Total Order</div>
    <div class="text-2xl font-bold mt-1">0</div>
  </div>
  <div class="p-4 rounded-2xl bg-[#141b2d]">
    <div class="text-sm text-gray-400">Omzet (hari ini)</div>
    <div class="text-2xl font-bold mt-1">Rp 0</div>
  </div>
  <div class="p-4 rounded-2xl bg-[#141b2d]">
    <div class="text-sm text-gray-400">Pending</div>
    <div class="text-2xl font-bold mt-1">0</div>
  </div>
  <div class="p-4 rounded-2xl bg-[#141b2d]">
    <div class="text-sm text-gray-400">Gagal</div>
    <div class="text-2xl font-bold mt-1">0</div>
  </div>
</div>

<div class="mt-6 p-4 rounded-2xl bg-[#141b2d]">
  <div class="text-sm text-gray-400 mb-2">Log Terakhir</div>
  <div class="text-gray-300">Belum ada data.</div>
</div>
@endsection
