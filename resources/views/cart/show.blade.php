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

<div class="p-2 flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
    </svg>
    <h3 class="ml-2">Cart</h3>
{{-- DATA - PELANGGAN --}}
    <div class="bg-indigo-900 rounded p-2 inline-block ml-5">
        <div class="flex items-center">
            <label for="pelanggan_id" class="text-yellow-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg><span class="font-bold">:</span>
            </label>
            @if ($cart->tipe_pelanggan === 'customer')
            <span class="text-white ml-1">cust. -</span><span class="text-pink-300 font-bold ml-1">{{ $pelanggan->username }} -</span><span class="text-sky-300 font-bold ml-1">{{ $pelanggan->nama }}</span>
            @elseif ($cart->tipe_pelanggan === 'guest')
            <span class="text-white ml-1">{{ $cart->tipe_pelanggan }} -</span><span class="text-sky-300 font-bold ml-1">{{ $guest_id }}</span>
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
                <div class="flex">
                    <div>
                        <div class="border rounded text-slate-700 bg-blue-100 hover:cursor-pointer hover:bg-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <div class="border rounded text-slate-700 bg-pink-100 hover:cursor-pointer hover:bg-pink-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-1">
                        <div class="border rounded p-1 inline-block">{{ $cart_items[$key]->jumlah }}</div>
                        <div>@if ($item->tipe_perhiasan === 'AT' || $item->tipe_perhiasan === 'GW')ps.@else pcs.@endif</div>
                    </div>
                </div>
                <input type="hidden" name="jumlah" id="jumlah_item-{{ $key }}" value="">
            </td>

        </tr>
        <tr>
            <td colspan="3">
                <div class="flex justify-between">
                    <div class="border border-sky-600 rounded text-xs p-1 m-1">
                        <div><span>Specs:</span><br>{{ $item->specs }}</div>
                        <div><span>Kode Brg.:</span><br>{{ $item->kode_item }}</div>
                        <form action="{{ route('carts.items.destroy', [$cart_items[$key]->id, $item->id ]) }}" method="POST" class="m-0" onsubmit="return confirm('Anda yakin ingin menghapus item ini dari Cart?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-pink-500 rounded p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <table>
                        <tr>
                            <td>Ongkos</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-pink-100">{{ $kadar_hargas[$key]->ongkos }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga/g</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-orange-100">{{ $kadar_hargas[$key]->harga }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga Total</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-emerald-100">{{ $kadar_hargas[$key]->harga * $item->berat }}</div></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <form action="" method="" class="mt-2">
        <input type="hidden" name="tipe_pelanggan" value="{{ $cart->tipe_pelanggan }}" readonly>
        <input type="hidden" name="pelanggan_id" value="{{ $pelanggan_id }}" readonly>
        <input type="hidden" name="guest_id" value="{{ $guest_id }}" readonly>
        <button class="btn-emerald rounded py-3 w-full text-lg">
            Proses Pembayaran
        </button>
    </form>
</div>
@endsection

