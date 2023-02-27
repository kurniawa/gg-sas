@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
{{-- <feedback></feedback> --}}
    <!-- The only way to do great work is to love what you do. - Steve Jobs -->
@section('content')
<div class="m-2 flex">
    <div class="flex items-center bg-white shadow drop-shadow p-2 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg><span class="font-bold">
        <h3 class="ml-2">Konfirmasi Data Pelanggan</h3>
    </div>
</div>

<div class="m-2 flex">
    @if (session()->has('success_') && session('success_')!=="")
    <div class="alert-success rounded">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warning_') && session('warning_')!=="")
    <div class="alert-warning rounded">{{ session('warning_') }}</div>
    @endif
    @if (session()->has('danger_') && session('danger_')!=="")
    <div class="alert-danger rounded">{{ session('danger_') }}</div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="alert-danger rounded">{{ session('errors_') }}</div>
    @endif
</div>

<div class="m-2">
    <table class="table-slim w-full">
        <tr>
            <td>
                <div class="bg-orange-100 p-2 font-bold rounded">Lanjutkan sebagai Guest</div>
            </td>
            <td>
                <button class="rounded bg-orange-600 p-1 text-white" type="button" onclick="toggleDD('tr_guest')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </td>
        </tr>
        <tr id="tr_guest" class="hidden">
            <td colspan="2">
                <form action="{{ route('pembelians.methode_pembayaran') }}" method="GET" class="m-0">
                    <div class="flex items-center border-b">
                        <div class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                            </svg>
                        </div>
                        <span class="ml-1">
                            Penjualan kembali perhiasan emas harus disertai dengan surat tanda pembelian.
                        </span>
                    </div>
                    <div class="flex items-center border-b">
                        <div class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                            </svg>
                        </div>
                        <span class="ml-1">
                            Apabila ada promo menarik, seperti misalnya perhitungan poin, maka pelanggan tamu tidak dapat turut serta dalam promo tersebut.
                        </span>
                    </div>
                    <button type="submit" class="btn-orange w-full py-3 text-base rounded mt-2">Konfirmasi Lanjut Sebagai Guest</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <div class="bg-sky-100 p-2 font-bold rounded">Input No. WhatsApp</div>
            </td>
            <td>
                <button class="rounded bg-sky-500 p-1 text-white" onclick="toggleDD('tr_nomor')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </td>
        </tr>
        <tr id="tr_nomor" class="hidden">
            <td colspan="2">
                <form action="{{ route('pembelians.konfirmasi_data_pelanggan') }}" method="post" class="m-0">
                    @csrf
                    <div>
                        <label for="phone" class="block">No. Kontak:</label>
                        <div class="flex">
                            <input type="text" value="+62" class="input w-16" disabled>
                            <input type="number" name="phone" id="phone" class="input ml-1" value="{{ old('phone') }}">
                        </div>
                    </div>
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
                    <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                    <button type="submit" name="pembelian_sebagai" value="phone" class="bg-sky-500 w-full py-3 rounded text-white text-lg mt-2">Konfirmasi</button>
                </form>
                <form action="{{ route('pembelians.test_konfirmasi_data_pelanggan') }}" class="m-0 mt-1">
                    <button class="bg-violet-500 text-white rounded py-3 w-full font-bold">Test Konfirmasi Data Pelanggan</button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <div class="bg-emerald-100 p-2 font-bold rounded">Pelanggan sudah terdaftar</div>
            </td>
            <td>
                <button class="rounded bg-emerald-600 p-1 text-white" onclick="toggleDD('tr_customer')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </td>
        </tr>
        <tr id="tr_customer" class="hidden">
            <td colspan="2">
                <form action="{{ route('pembelians.konfirmasi_data_pelanggan') }}" method="post" class="mt-2">
                    @csrf
                    <div class="flex items-center border-b">
                        <div class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </div>
                        <span class="ml-1">
                            Data pembelian dan penjualan tersimpan pada database. Oleh karena itu memungkinan untuk menjual tanpa surat, selama data diri sudah lengkap dan aktual.
                        </span>
                    </div>
                    <div class="flex items-center border-b">
                        <div class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </div>
                        <span class="ml-1">
                            Pelanggan dapat log-in ke akun miliknya dan melihat histori pembelian dan penjualan perhiasan.
                        </span>
                    </div>
                    <div class="flex items-center border-b">
                        <div class="text-emerald-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </div>
                        <span class="ml-1">
                            Pelanggan dapat ikut serta dalam promo seperti misalnya akumulasi poin, apabila promo diadakan.
                        </span>
                    </div>
                    <button type="submit" name="cart_id" value="{{ $cart_id }}" class="bg-emerald-500 text-white w-full py-3 rounded font-bold text-base">Verfikasi Pelanggan</button>
                </form>
                <form action="{{ route('pembelians.test_konfirmasi_data_pelanggan') }}" class="m-0 mt-1">
                    <button class="bg-violet-500 text-white rounded py-3 w-full font-bold">Test Konfirmasi Data Pelanggan</button>
                </form>
            </td>
        </tr>
    </table>
</div>

<script>
    function toggleDD(id) {
        $(`#${id}`).toggle(350);
    }
</script>
@endsection

