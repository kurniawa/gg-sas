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
    <button type="submit" class="bg-emerald-500 text-white font-bold rounded w-full py-3" name="pembelian_sebagai" value="{{ $pembelian_sebagai }}">Lanjutkan</button>
</form>

@endsection

