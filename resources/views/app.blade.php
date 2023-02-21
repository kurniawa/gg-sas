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

@auth
<div class="grid grid-cols-3 gap-2 mx-5 mt-5">
    <a
        href="{{ route('carts.pilih_customer') }}"
        class="bg-indigo-400 shadow drop-shadow rounded hover:bg-emerald-500 text-white"
    >
        <div class="flex items-center h-3/4 justify-center">
            <div class="w-2/3 h-2/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>

            </div>
        </div>
        <div
            class="font-semibold flex h-1/4 justify-center items-center"
        >
        Pembelian
        </div>
    </a>
    <a href="{{ route('items.index') }}" class="bg-indigo-400 shadow drop-shadow rounded hover:bg-emerald-500 text-white">
        <div class="flex items-center h-3/4 justify-center">
            <div class="w-2/3 h-2/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="font-semibold flex h-1/4 justify-center items-center">Penjualan</div>
    </a>
    <a href="{{ route('items.index') }}" class="bg-indigo-400 shadow drop-shadow rounded hover:bg-emerald-500 text-white">
        <div class="flex items-center h-3/4 justify-center">
            <div class="w-2/3 h-2/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
            </div>
        </div>
        <div class="font-semibold flex h-1/4 justify-center items-center">Stock Items</div>
    </a>
</div>
@endauth
@endsection

