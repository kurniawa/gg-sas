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

<div class="m-2 flex">
    <div class="flex items-center bg-white shadow drop-shadow p-2 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
        </svg><span class="font-bold">
        <h3 class="ml-2">Konfirmasi Data Pelanggan</h3>
    </div>
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
                <form action="" class="mt-2">
                    <button class="btn-orange w-full py-3 text-base rounded">Konfirmasi Lanjut Sebagai Guest</button>
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
                <form action="" method="POST" class="mt-2">
                    <div class="flex">
                        <input type="number" name>
                        <input type="number" name="no_kontak" id="no_kontak">
                    </div>
                    <div class="flex items-center border-b">
                        <div class="text-emerald-500">
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
                    <button class="bg-sky-500 w-full py-3 rounded text-white text-lg">Konfirmasi</button>
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
                <form action="" class="mt-2">
                    <button class="btn-emerald w-full py-3 text-base rounded">Cari Pelanggan Teregistrasi</button>
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

