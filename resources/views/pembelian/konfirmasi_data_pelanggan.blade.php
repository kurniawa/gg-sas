@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
{{-- <feedback></feedback> --}}
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
@section('content')
<div class="m-2 p-2 inline-block bg-white rounded shadow drop-shadow">
    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
        </svg>
        <h3 class="ml-1">Verifikasi Customer</h3>
    </div>
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
        <tr><td class="font-bold">No. Kontak - WA</td><td>:</td><td>0{{ $pelanggan->phone }}</td></tr>
    </table>
</div>

@if ($pembelian_sebagai === 'phone')
<div class="flex items-center border-b mt-1">
    <div class="text-emerald-500 mt-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
        </svg>
    </div>
    <span class="ml-1">
        Penjualan kembali perhiasan emas bisa tanpa surat, namun pelanggan harus melengkapi dan memperbarui data diri.
    </span>
</div>
<div class="flex items-center border-b">
    <div class="text-emerald-500">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
        </svg>
    </div>
    <span class="ml-1">
        Apabila sudah memperbarui dan melengkapi data diri, maka pelanggan akan terdaftar/teregistrasi dan dapat menikmati beberapa manfaat sebagai pelanggan terdaftar.
    </span>
</div>
@elseif ($pembelian_sebagai === 'customer')
@endif

<form action="{{ route('pembelians.methode_pembayaran') }}" method="post" class="m-2">
    @csrf
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">
    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
    <button type="submit" class="bg-emerald-500 text-white font-bold rounded w-full py-3 text-base" name="pembelian_sebagai" value="{{ $pembelian_sebagai }}">Lanjutkan</button>
</form>

<form action="{{ route('pembelians.test_methode_pembayaran') }}" method="get" class="mx-2">
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">
    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
    <button type="submit" class="bg-violet-500 text-white font-bold rounded w-full py-3 text-base" name="pembelian_sebagai" value="guest">Test Lanjut Methode Bayar Guest</button>
</form>

<form action="{{ route('pembelians.test_methode_pembayaran') }}" method="get" class="mx-2 mt-1">
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan->id }}">
    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
    <button type="submit" class="bg-violet-500 text-white font-bold rounded w-full py-3 text-base" name="pembelian_sebagai" value="customer">Test Lanjut Methode Bayar Cust</button>
</form>

@endsection

