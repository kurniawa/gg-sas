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
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="alert-danger rounded">{{ session('errors_') }}</div>
    @endif
</div>

<div class="px-2 flex items-center">
    <div class="flex items-center border rounded bg-white shadow drop-shadow p-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </svg>
        <h3 class="ml-2 text-xl">Cart</h3>
    </div>
{{-- DATA - PELANGGAN --}}
    <div class="bg-indigo-900 rounded p-2 inline-block ml-2">
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
    <button class="border border-violet-500 rounded text-violet-500 p-1 ml-2 flex items-center" onclick="toggleEditPelanggan(this)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        {{-- <span>E.Pelanggan</span> --}}
    </button>
</div>
{{-- EDIT - PELANGGAN --}}
<div id="div-edit-pelanggan" class="border border-violet-500 rounded p-1 m-1 hidden">
    <label for="">Pelanggan:</label>
    <select name="pelanggan_sebagai" id="select-pelanggan-sebagai" class="form-select" onchange="pilihPelangganSebagai()">
        <option value="">-</option>
        <option value="guest">guest / tamu</option>
        <option value="customer">pelanggan ter-registrasi</option>
    </select>
    <form action="{{ route('carts.update_customer') }}" method="post" class="m-2 p-2 border rounded hidden" id="form-guest">
        @csrf
        <label>Pilih Guest:</label>
        <select name="guest_id" id="select_guest" class="input">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
        </select>
        <div class="text-center mt-2">
            <button type="submit" class="bg-indigo-500 text-white p-2 rounded" name="cart_id" value="{{ $cart->id }}">Tetapkan Pelanggan</button>
        </div>
        <input type="hidden" name="tipe_pelanggan" value="guest" readonly>
        <input type="hidden" name="pelanggan_id" value="" readonly>
    </form>
    <form action="{{ route('carts.verifikasi_customer') }}" method="get" class="m-2 p-2 border rounded hidden" id="form-customer">
        <h3 class="font-bold">Verfikasi Data Pelanggan</h3>
        <label class="block mt-1" for="pelanggan_id">Pelanggan-ID:</label>
        <input type="text" class="input mt-1" name="pelanggan_id" id="pelanggan_id" placeholder="Pelanggan-ID...">
        <label class="block mt-1" for="username">Username:</label>
        <input type="text" class="input mt-1" name="username" id="username" placeholder="Username...">
        <input type="hidden" name="tipe_pelanggan" value="customer">

        <div class="flex justify-center">
            <button type="submit" class="bg-emerald-500 text-white p-2 rounded flex items-center justify-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <span>Cek & Verifikasi Data Pelanggan</span>
            </button>

            <input type="hidden" name="goback" value="carts.show" readonly>
            <input type="hidden" name="previous_data" value="{{ $cart->id }}" readonly>
            <input type="hidden" name="cart_id" value="{{ $cart->id }}" readonly>
        </div>
    </form>
</div>
{{-- END - EDIT PELANGGAN --}}
<div class="px-2">
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
                <div class="flex justify-between">
                    <div>
                        <div class="border rounded text-slate-700 bg-blue-100 hover:cursor-pointer hover:bg-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                            </svg>
                        </div>
                        <div class="border rounded text-slate-700 bg-pink-100 hover:cursor-pointer hover:bg-pink-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    <div>
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
                        <div class="flex justify-between">
                            <form action="{{ route('carts.items.destroy', [$cart_items[$key]->id, $item->id ]) }}" method="POST" class="m-0" onsubmit="return confirm('Anda yakin ingin menghapus item ini dari Cart?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-pink-500 rounded p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                            <button type="button" class="text-slate-500" onclick="toggleEditHarga({{ $key }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <table>
                        <tr>
                            <td>Ongkos/g</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-pink-100">{{ $cart_items[$key]->ongkos }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga/g</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-orange-100">{{ $cart_items[$key]->harga }}</div></td>
                        </tr>
                        <tr>
                            <td>Harga Total</td><td>:</td><td><div class="toFormatCurrencyRp rounded font-bold bg-emerald-100">{{ $cart_items[$key]->harga_total }}</div></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
        <tr id="tr-edit-harga-{{ $key }}" class="hidden">
            <td colspan="3">
                <div class="border border-orange-500 rounded p-1">
                    {{-- <form action="{{ route('carts.items.update',[$cart->id, $item->id]) }}" method="post"> --}}
                    <form action="{{ route('carts.items.update', [$cart_items[$key]->id, $item->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <table class="w-full">
                            <tr>
                                <td>Ongkos</td><td>:</td><td><input type="number" step="any" name="ongkos" value="{{ $cart_items[$key]->ongkos }}" class="input w-28" onkeyup="formatOngkos(this.value, {{ $key }})"></td><td><div class="flex justify-between"><span>Rp</span><span id="ongkos-formatted-{{ $key }}">{{ number_format($cart_items[$key]->ongkos,0,',','.') }}</span></div></td>
                                <td>
                                    <div class="inline-block relative">
                                        <button type="button" class="absolute -top-11 -right-3 bg-red-500 w-6 h-6 rounded-full text-white" onclick="hideEditHarga({{ $key }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr><td>Harga/g</td><td>:</td><td><input type="number" step="any" name="harga" id="harga-{{ $key }}" value="{{ $cart_items[$key]->harga }}" class="input w-28" onkeyup="sesuaikanHargaT(this.value, {{ $key }}, {{ $item->berat }})"></td><td><div class="flex justify-between"><span>Rp</span><span id="harga-formatted-{{ $key }}">{{ number_format($cart_items[$key]->harga,0,',','.') }}</span></div></td></tr>
                            <tr><td>Harga T.</td><td>:</td><td><input type="number" step="any" name="harga_total" id="harga-t-{{ $key }}" value="{{ $cart_items[$key]->harga_total }}" class="input w-28" onkeyup="sesuaikanHargaG(this.value, {{ $key }}, {{ $item->berat }})"></td><td><div class="flex justify-between"><span>Rp</span><span id="harga-total-formatted-{{ $key }}">{{ number_format($cart_items[$key]->harga_total,0,',','.') }}</span></div></td></tr>
                        </table>

                        <div class="text-center">
                            <button type="submit" name="cart_item_id" value="{{ $cart_items[$key]->id }}" class="bg-orange-500 text-white p-1 rounded mt-1">Konfirmasi Edit</button>
                        </div>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    <form action="{{ route('pembelians.create') }}" method="GET" class="mt-2">
        <input type="hidden" name="cart_id" value="{{ $cart->id }}" readonly>
        <button class="btn-emerald rounded py-3 w-full text-lg">
            Proses Pembayaran
        </button>
    </form>
</div>
<script>
    function sesuaikanHargaG(harga_t, index, massa) {
        let el_harga = document.getElementById(`harga-${index}`);
        let el_harga_formatted = document.getElementById(`harga-formatted-${index}`);
        let el_harga_total_formatted = document.getElementById(`harga-total-formatted-${index}`);
        el_harga.value = (harga_t / (massa / 100)).toFixed(0);
        el_harga_formatted.textContent = formatNumberHargaRemoveDecimal(el_harga.value);
        el_harga_total_formatted.textContent = formatNumberHargaRemoveDecimal(harga_t);
    }

    function sesuaikanHargaT(harga_g, index, massa) {
        let el_harga_t = document.getElementById(`harga-t-${index}`);
        let el_harga_formatted = document.getElementById(`harga-formatted-${index}`);
        let el_harga_total_formatted = document.getElementById(`harga-total-formatted-${index}`);
        el_harga_t.value = (harga_g * (massa / 100)).toFixed(0);
        el_harga_total_formatted.textContent = formatNumberHargaRemoveDecimal(el_harga_t.value);
        el_harga_formatted.textContent = formatNumberHargaRemoveDecimal(harga_g);
    }

    function formatOngkos(ongkos, index) {
        // console.log(ongkos);
        let el_ongkos_formatted = document.getElementById(`ongkos-formatted-${index}`);
        el_ongkos_formatted.textContent = formatNumberHargaRemoveDecimal(ongkos);
    }

    function toggleEditHarga(index) {
        $(`#tr-edit-harga-${index}`).toggle(300);
    }

    function hideEditHarga(index) {
        $(`#tr-edit-harga-${index}`).hide(300);
    }

    function pilihPelangganSebagai() {
        let select_pelanggan_sebagai = document.getElementById('select-pelanggan-sebagai');
        console.log(select_pelanggan_sebagai.value);

        $(`#form-guest`).hide();
        $(`#form-customer`).hide();

        if (select_pelanggan_sebagai.value === 'guest') {
            $(`#form-guest`).show(300);
        } else if (select_pelanggan_sebagai.value === 'customer') {
            $(`#form-customer`).show(300);
        }
    }

    function toggleEditPelanggan(btn_edit_pelanggan) {
        $div_edit_pelanggan = $('#div-edit-pelanggan');
        if ($div_edit_pelanggan.is(':hidden')) {
            btn_edit_pelanggan.classList.add('bg-violet-300');
        } else {
            btn_edit_pelanggan.classList.remove('bg-violet-300');
        }
        $div_edit_pelanggan.toggle(300);
        // console.log($div_edit_pelanggan.is(':visible'));
    }
</script>
@endsection

