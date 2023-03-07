@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
{{-- <feedback></feedback> --}}
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
@section('content')
<div class="m-2">
    <h3>Verifikasi Customer</h3>
</div>
<div class="m-2">
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warning_') && session('warning_')!=="")
    <div class="alert-warning rounded">{{ session('warning_') }}</div>
    @endif
    @if (session()->has('danger_') && session('danger_')!=="")
    <div class="alert-danger rounded">{{ session('danger_') }}</div>
    @endif
</div>

<div class="m-2">
    <table class="table-nice">
        <tr><td class="font-bold">ID</td><td>:</td><td>{{ $pelanggan->id }}</td></tr>
        <tr><td class="font-bold">Username</td><td>:</td><td>{{ $pelanggan->username }}</td></tr>
        <tr><td class="font-bold">Nama</td><td>:</td><td>{{ $pelanggan->nama }}</td></tr>
    </table>
</div>

@if ($cart_id !== null)
<form action="{{ route('carts.update_customer') }}" method="post" class="m-2">
    @csrf
    <input type="hidden" name="tipe_pelanggan" value="customer" readonly>
    <input type="hidden" name="cart_id" value="{{ $cart_id }}" readonly>
    <input type="hidden" name="guest_id" value="" readonly>
    <div class="text-center">
        <button type="submit" class="bg-emerald-500 text-white p-2 rounded" name="pelanggan_id" value="{{ $pelanggan->id }}">Konfirmasi Ubah Pelanggan</button>

    </div>
</form>
@else
<form action="{{ route('carts.create') }}" class="m-2">
    <input type="hidden" name="tipe_pelanggan" value="{{ $tipe_pelanggan }}">
    <div class="text-center">
        <button type="submit" class="bg-emerald-500 text-white p-2 rounded" name="pelanggan_id" value="{{ $pelanggan->id }}">Lanjutkan</button>
    </div>
</form>
@endif

@endsection

