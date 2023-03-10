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

<div class="ml-2 inline-block">
    <div class="p-2 flex items-center bg-white rounded shadow drop-shadow">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
        </svg>
        <h3 class="ml-2 font-bold">Proses Pembayaran</h3>
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
        <div class="flex items-center">
            <input type="checkbox" id="checkbox-tunai" name="tunai" value="yes" onclick="toggleTunai(this)">
            <label for="checkbox-tunai" class="ml-2">Tunai</label>
        </div>
        <input type="number" name="jumlah_tunai" id="jumlah_tunai" class="jumlah-bayar input ml-5 hidden" step="any" min="0" onkeyup="hitungTotalBayar()">
        <div class="flex items-center mt-2">
            <input type="checkbox" id="checkbox-non-tunai" name="non_tunai" value="yes" onclick="toggleNonTunai(this)">
            <label for="checkbox-non-tunai" class="ml-2">Non-Tunai</label>
        </div>
        <div id="div-non-tunai" class="hidden">
            <div id="daftar-input-pembayaran-non-tunai"></div>
            <div class="relative w-3/4 ml-5 mt-1">
                <div class="border rounded p-3 flex items-center justify-between hover:cursor-pointer hover:bg-slate-100" onclick="toggleEWallet()">
                    <span>Pilih Bank/E-Wallet</span>
                    <div class="border rounded bg-white shadow drop-shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                <div id="dd-daftar-ewallet" class="border absolute top-12 bg-white w-full hidden">
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','bca')" id="bca"><img src="{{ asset('img/logo-bank-bca.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','bri')" id="bri"><img src="{{ asset('img/logo-bank-bri.png') }}" class="h-full"><span class="font-bold text-blue-800 text-base ml-2">BRI</span></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','mandiri')" id="mandiri"><img src="{{ asset('img/logo-bank-mandiri.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','bni')" id="bni"><img src="{{ asset('img/logo-bank-bni.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','cimb')" id="cimb"><img src="{{ asset('img/logo-bank-cimb.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','ocbc')" id="ocbc"><img src="{{ asset('img/logo-bank-ocbc.jpg') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','bjb')" id="bjb"><img src="{{ asset('img/logo-bank-bjb.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('bank','maybank')" id="maybank"><img src="{{ asset('img/logo-bank-maybank.svg') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('ewallet','gopay')" id="gopay"><img src="{{ asset('img/logo-ewallet-gopay.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('ewallet','shopee')" id="shopee"><img src="{{ asset('img/logo-ewallet-shopee.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('ewallet','dana')" id="dana"><img src="{{ asset('img/logo-ewallet-dana.png') }}" class="h-full"></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('ewallet','ovo')" id="ovo"><img src="{{ asset('img/logo-ewallet-ovo.png') }}" class="h-full"><span class="font-bold text-violet-800 text-base ml-2">OVO</span></div>
                    <div class="flex items-center h-11 border-b py-2 pl-2 hover:bg-slate-100" onclick="tambahPembayaranNonTunai('lain-lain','lain-lain')"><span class="font-bold text-base ml-2">Lain - lain</span></div>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <div class="">
                <span class="font-bold text-orange-500">Sisa Bayar</span>
                <div class="font-bold text-lg"><span>Rp </span><span id="sisa-bayar"></span></div>
            </div>
            <div class="ml-2">
                <span class="font-bold text-emerald-500">Total Bayar</span>
                <div class="font-bold text-lg"><span>Rp </span><span id="total-bayar"></span></div>
            </div>
        </div>
        <input type="hidden" id="ipt-total-bayar" name="total_bayar" readonly>
        <input type="hidden" id="ipt-sisa-bayar" name="sisa_bayar" readonly>
        @if ($errors->any())
        <div class="m-2 alert-danger">
            @foreach ($errors->all() as $error)
            <span>{{ $error }}</span>
            @endforeach
        </div>
        @endif
        <button class="btn-emerald rounded py-3 w-full text-lg mt-3">
            Konfirmasi Pembayaran
        </button>
        <input type="hidden" name="cart_id" value="{{ $cart->id }}" readonly>
        <input type="hidden" name="total_tagihan" value="{{ $total_tagihan }}" readonly>
    </form>
</div>

<script>
    function toggleEWallet() {
        $('#dd-daftar-ewallet').toggle(300);
    }

    function hideEWallet() {
        $('#dd-daftar-ewallet').hide(300);
    }

    var div_input_non_tunai = document.getElementById('daftar-input-pembayaran-non-tunai');
    function tambahPembayaranNonTunai(tipe, nama_instansi) {
        var html_input = '';
        if (tipe === 'lain-lain') {
            html_input += `
            <div class="ml-5 flex mt-1">
                <input type="text" name="nama_instansi[]" value="${nama_instansi}" class="input w-1/4">
                <input type="number" name="jumlah_non_tunai[]" step=1 min=0 class="input ml-1 jumlah-bayar" onkeyup="hitungTotalBayar()">
                <input type="hidden" name="tipe_non_tunai[]" value="${tipe}" readonly>
            </div>
            `;
        } else {
            html_input += `
            <div class="ml-5 flex mt-1">
                <input type="text" name="nama_instansi[]" value="${nama_instansi}" class="input bg-slate-100 w-1/4" readonly>
                <input type="number" name="jumlah_non_tunai[]" step=1 min=0 class="input ml-1 jumlah-bayar" onkeyup="hitungTotalBayar()">
                <input type="hidden" name="tipe_non_tunai[]" value="${tipe}" readonly>
            </div>
            `;
            document.getElementById(nama_instansi).remove();
        }
        div_input_non_tunai.insertAdjacentHTML('beforeend', html_input);
        hideEWallet();
    }

    function toggleTunai(checkbox_tunai) {
        $ipt_tunai = $('#jumlah_tunai');
        if (checkbox_tunai.checked) {
            $ipt_tunai.show(300);
        } else {
            $ipt_tunai.hide(300);
        }
    }

    function toggleNonTunai(checkbox_non_tunai) {
        $div_non_tunai = $('#div-non-tunai');
        if (checkbox_non_tunai.checked) {
            $div_non_tunai.show(300);
        } else {
            $div_non_tunai.hide(300);
        }
    }

    const total_tagihan = {!! json_encode($total_tagihan, JSON_HEX_TAG) !!};
    function hitungTotalBayar() {
        let arr_jumlah_bayar = document.querySelectorAll('.jumlah-bayar');
        let total_bayar = 0;
        arr_jumlah_bayar.forEach(jumlah_bayar => {
            if (jumlah_bayar.value !== '') {
                total_bayar = total_bayar + parseInt(jumlah_bayar.value);
            }
        });
        // console.log(total_bayar);
        let sisa_bayar = total_tagihan - total_bayar;

        document.getElementById('total-bayar').textContent = formatNumberHargaRemoveDecimal(total_bayar.toString());
        document.getElementById('sisa-bayar').textContent = formatNumberHargaRemoveDecimal(sisa_bayar.toString());
        document.getElementById('ipt-total-bayar').value = total_bayar;
        document.getElementById('ipt-sisa-bayar').value = sisa_bayar;
    }
</script>
@endsection

