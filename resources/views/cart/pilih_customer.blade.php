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

<div class="grid grid-cols-3 gap-2 mx-5 mt-5">
    <button type="button" class="bg-blue-400 shadow drop-shadow rounded hover:bg-emerald-500 text-white" onclick="toggleShowForm('customer')">
        <div class="flex items-center h-3/4 justify-center">
            <div class="w-2/3 h-2/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
        <div class="font-semibold flex h-1/4 justify-center items-center">Pelanggan</div>
    </button>
    <button class="bg-blue-400 shadow drop-shadow rounded hover:bg-emerald-500 text-white" onclick="toggleShowForm('guest')">
        <div class="flex items-center h-3/4 justify-center">
            <div class="w-2/3 h-2/3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-full h-full">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
        </div>
        <div class="font-semibold flex h-1/4 justify-center items-center">Guest</div>
    </button>
</div>

{{-- ELEMENT - CART YANG AVAILABLE --}}
@if (count($carts_data['carts'])!==0)
<div class="m-2">
    <h3>Cart List</h3>
    <table class="table-nice">
        <tr><th>Tipe</th><th>Username</th><th>Jml.</th></tr>
        @foreach ($carts_data['carts'] as $key=>$cart)
        <tr>
            <td>{{ $cart->tipe_pelanggan }}</td>
            <td>{{ $carts_data['usernames'][$key] }}</td>
            <td>{{ $carts_data['count_items'][$key] }}</td>
            <td>
                <div class="flex items-center">
                    <a href="{{ route('carts.show',$cart->id) }}" class="bg-yellow-500 text-white font-bold p-1 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                    <form action="{{ route('carts.create') }}" class="m-0 ml-1">
                        <input type="hidden" name="pelanggan_id" value="{{ $cart->pelanggan_id }}">
                        <input type="hidden" name="guest_id" value="{{ $cart->guest_id }}">
                        <button type="submit" class="bg-emerald-500 text-white p-1 flex items-center rounded" name="tipe_pelanggan" value="{{ $cart->tipe_pelanggan }}">
                            <span class="font-bold">+</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif

@if ($errors->any())
<div class="alert-danger">
    @foreach ($errors->all() as $error)
    <span>{{ $error }} </span>
    @endforeach
</div>
@endif

<form action="{{ route('carts.verifikasi_customer') }}" method="GET" class="m-2 p-2 border rounded hidden" id="customer">
    <h3>Verfikasi Data Pelanggan</h3>
    <label class="block mt-1" for="pelanggan_id">Pelanggan-ID:</label>
    <input type="text" class="input mt-1" name="pelanggan_id" id="pelanggan_id" placeholder="Pelanggan-ID...">
    <label class="block mt-1" for="username">Username:</label>
    <input type="text" class="input mt-1" name="username" id="username" placeholder="Username...">
    <input type="hidden" name="tipe_pelanggan" value="customer">

    <button type="submit" class="btn-emerald rounded flex items-center justify-center mt-2" onclick="verifikasiDataPelanggan()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
        Cek & Verifikasi Data Pelanggan
    </button>
</form>
<form action="{{ route('carts.create') }}" method="GET" class="m-2 p-2 border rounded hidden" id="guest">
    <h3>Pilih Guest</h3>
    <select name="guest_id" id="select_guest" class="input">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select>
    <input type="hidden" name="tipe_pelanggan" value="guest">
    <button type="submit" class="btn-indigo rounded flex items-center justify-center mt-2">
        Lanjutkan
    </button>
</form>

<script>
    function toggleShowForm(form_name) {
        if (form_name==='customer') {
            $(`#${form_name}`).show(300);
            $(`#guest`).hide(300);
        } else if (form_name==='guest') {
            $(`#${form_name}`).show(300);
            $(`#customer`).hide(300);
        }
    }
    function verifikasiDataPelanggan() {

    }
</script>
@endsection

