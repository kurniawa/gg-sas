@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
{{-- <feedback></feedback> --}}
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
@section('content')
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

<div class="m-2 inline-block">
    <div class="p-2 flex items-center bg-white rounded shadow drop-shadow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
        </svg>
        <h3 class="ml-2">Proses Pembayaran</h3>
    </div>
</div>
{{-- DATA - PELANGGAN --}}
<div class="m-2">
    <div class="bg-indigo-900 rounded p-2 inline-block">
        <div class="flex items-center">
            <label for="pelanggan_id" class="text-yellow-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg><span class="font-bold">:</span>
            </label>
            @if ($cart->tipe_pelanggan === 'customer')
            <span class="text-white ml-1">cust. -</span><span class="text-pink-300 font-bold ml-1">{{ $pelanggan->username }} -</span><span class="text-sky-300 font-bold ml-1">{{ $pelanggan->nama }}</span>
            @elseif ($cart->tipe_pelanggan === 'guest')
            <span class="text-white ml-1">{{ $cart->tipe_pelanggan }} -</span><span class="text-sky-300 font-bold ml-1">{{ $cart->guest_id }}</span>
            @endif
        </div>
    </div>
</div>
<div class="p-2">
    <table class="mt-2 w-full">
        @foreach ($cart->items as $key=>$item)
        <tr>
            <td>
                @if (count($item->photos) !== 0)
                <div class="w-9"><img src="{{ asset('storage/' . $item->photos[0]->path) }}" alt="" class="w-full"></div>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="text-slate-500 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                @endif
            </td>
            <td>{{ $item->nama }}</td>
            <td>
                {{ $cart_items[$key]->jumlah }} @if ($item->tipe_perhiasan === 'AT' || $item->tipe_perhiasan === 'GW')ps.@else pcs.@endif
                <input type="hidden" name="jumlah" id="jumlah_item-{{ $key }}" value="">
            </td>

        </tr>
        <tr>
            <td colspan="3">
                <div class="flex justify-between">
                    <div class="border border-sky-600 rounded text-xs p-1 m-1">
                        <div><span>Specs:</span><br>{{ $item->specs }}</div>
                        <div><span>Kode Brg.:</span><br>{{ $item->kode_item }}</div>
                    </div>
                    <table>
                        <tr>
                            <td>Ongkos</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold">{{ $cart_items[$key]->ongkos }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga/g</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold">{{ $cart_items[$key]->harga }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga Total</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold">{{ $cart_items[$key]->harga_total }}</div></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="text-end">
        <div class="inline-block">
            <span class="font-bold text-red-500">Total Tagihan</span>
            <div class="font-bold text-lg"><span>Rp </span><span>{{ number_format($total_tagihan,0,',','.') }},-</span></div>
        </div>
    </div>

    <form action="{{ route('pembelians.store') }}" method="POST" class="mt-2">
        @csrf
        <input type="hidden" name="cart_id" value="{{ $cart->id }}" readonly>
        <button class="btn-emerald rounded py-3 w-full text-lg">
            Konfirmasi Pembayaran
        </button>
    </form>
</div>
@endsection

