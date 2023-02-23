@extends('layouts.main_layout')
@section('title','GL.SAS')
{{-- <navbar :goback="$goback"></navbar> --}}
@section('content')

<div class="p-2 flex items-center">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
    </svg>
    <h3 class="ml-2">+ Tambah Item Cart</h3>
{{-- DATA - PELANGGAN --}}
    <div class="bg-indigo-900 rounded p-2 inline-block ml-2">
        <div class="flex items-center">
            <label for="pelanggan_id" class="text-yellow-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg><span class="font-bold">:</span>
            </label>
            @if ($tipe_pelanggan === 'customer')
            <span class="text-white ml-1">cust. -</span><span class="text-pink-300 font-bold ml-1">{{ $pelanggan->username }} -</span><span class="text-sky-300 font-bold ml-1">{{ $pelanggan->nama }}</span>
            @elseif ($tipe_pelanggan === 'guest')
            <span class="text-white ml-1">{{ $tipe_pelanggan }} -</span><span class="text-sky-300 font-bold ml-1">{{ $guest_id }}</span>
            @endif
        </div>
    </div>
</div>

<form method="post" action="{{ route('carts.store') }}" class="m-2" enctype="multipart/form-data"
    x-data="{
        item:{
            tipe_barang:'Perhiasan',
        }
    }"
    >
    @csrf

    <input type="hidden" name="tipe_pelanggan" value="{{ $tipe_pelanggan }}" readonly>
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan_id }}" readonly>
    <input type="hidden" name="guest_id" value="{{ $guest_id }}" readonly>
    <div class="flex mt-1">
        {{-- TIPE BARANG --}}
        <select id="tipe_barang" class="input" x-model="item.tipe_barang" name="tipe_barang" value="{{ old('tipe_barang') }}">
            <option value="">-</option>
            @foreach ($tipe_barangs as $tipe_barang)
            <option value="{{ $tipe_barang['tipe'] }}">{{ $tipe_barang['tipe'] }}</option>
            @endforeach
        </select>
        <template x-if="item.tipe_barang==='Perhiasan'">
            {{-- TIPE PERHIASAN --}}
            <div class="ml-1 flex">
                <div>
                    <select
                        id="tipe_perhiasan"
                        name="tipe_perhiasan"
                        onchange="setOpsiJenisPerhiasan(this.value)"
                        class="input"
                    >
                        <option value="">-</option>
                        @foreach ($kodetipeperhiasans as $kode_tipe_perhiasan)
                            <option value="{{ $kode_tipe_perhiasan }}" {{ old('tipe_perhiasan') === $kode_tipe_perhiasan ? 'selected' : '' }}>{{ $kode_tipe_perhiasan }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- JENIS PERHIASAN --}}
                <div class="ml-1">
                    <input id="jenis_perhiasan" class="input w-full" type="text" name="jenis_perhiasan" placeholder="Jenis Perhiasan..." value="{{ old('jenis_perhiasan') }}"/>
                </div>
            </div>
        </template>
    </div>
    <template x-if="item.tipe_barang==='Perhiasan'">
        <div>
            <div class="flex mt-1 items-center">
                {{-- RANGE USIA --}}
                <div>
                    <div>
                        <label for="" class="block">Range Usia:</label>
                        <select id="range_usia" class="input" onchange="generateNama()" name="range_usia">
                            <option value="">-</option>
                            @if (old('range_usia'))
                            @foreach ($rangeusias as $range_usia)
                            <option value="{{ $range_usia['nama'] }}" {{ old('range_usia') === $range_usia['nama'] ? 'selected' : '' }}>{{ $range_usia['nama'] }}</option>
                            @endforeach
                            @else
                            @foreach ($rangeusias as $range_usia)
                            <option value="{{ $range_usia['nama'] }}" {{ $range_usia['nama'] === 'dewasa' ? 'selected' : '' }}>{{ $range_usia['nama'] }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                {{-- WARNA EMAS --}}
                <div class="ml-1">
                    <div>
                        <label for="" class="block">Warna Emas:</label>
                        <select id="warna_emas" class="input" onchange="generateNama()" name="warna_emas">
                            <option value="">-</option>
                            @foreach ($warnaemass as $warna_emas)
                            <option value="{{ $warna_emas['nama'] }}" {{ old('warna_emas') === $warna_emas['nama'] ? 'selected' : '' }}>{{ $warna_emas['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- NAMPAN --}}
                <div class="ml-1">
                    <div>
                        <label for="" class="block">Nampan:</label>
                        <select id="nampan" class="input" onchange="generateNama()" name="nampan">
                            @foreach ($nampans as $nampan)
                            <option value="{{ $nampan['codename'] }}" {{ old('nampan') === $nampan['codename'] ? 'selected' : '' }}>{{ $nampan['codename'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- MATA --}}
            {{-- <item.mata :matas="$matas"></item.mata> --}}
            <div class="border border-emerald-500 rounded p-1 mt-1">
                <div class="flex items-center">
                    <button class="bg-emerald-500 rounded p-1" type="button" onclick="addMata()">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="text-white w-6 h-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <span class="ml-2 font-bold">Mata</span>
                </div>
                <div id="div-child-mata"></div>
            </div>

            {{-- MAINAN --}}
            {{-- <item.mainan :mainans="$mainans"></item.mainan> --}}
            <div class="border border-orange-500 rounded p-1 mt-1">
                <div class="flex items-center">
                    <button class="bg-orange-500 rounded p-1" type="button" onclick="add_mainan()">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="text-white w-6 h-6"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <span class="ml-2 font-bold">Mainan</span>
                </div>
                <div id="div-child-mainan"></div>
            </div>

            <div class="flex">
                {{-- ELEMENT - PLAT --}}
                {{-- <item.plat></item.plat> --}}
                <div class="w-full ml-1">
                    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
                    <div class="border border-indigo-500 rounded p-1 mt-1">
                        <div class="flex items-center">
                            <button class="bg-indigo-500 rounded p-1" type="button" onclick="show_plat()">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="text-white w-6 h-6"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                            <span class="ml-2 font-bold">Plat</span>
                        </div>
                        <div id="div-child-plat" class="hidden">
                            <div class="flex items-center mt-1">
                                <div>
                                    <input
                                        id="input_plat"
                                        type="number"
                                        placeholder="plat"
                                        class="input w-11/12"
                                        name="plat"
                                        onkeyup="memorizeValue_plat(this.value)"
                                        value="{{ old('plat') }}"
                                    />
                                </div>
                                <button
                                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                                    onclick="hide_plat()"
                                    type="button"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="text-white w-5 h-5"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ELEMENT - UKURAN --}}
                {{-- <item.ukuran></item.ukuran> --}}
                <div class="w-full ml-1">
                    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
                    <div class="border border-pink-500 rounded p-1 mt-1">
                        <div class="flex items-center">
                            <button class="bg-pink-500 rounded p-1" type="button" onclick="show_ukuran()">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="text-white w-6 h-6"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </button>
                            <span class="ml-2 font-bold">Ukuran</span>
                        </div>
                        <div id="div-child-ukuran" class="hidden">
                            <div class="flex items-center mt-1">
                                <div>
                                    <input
                                        id="input_ukuran"
                                        type="number"
                                        placeholder="ukuran"
                                        class="input w-11/12"
                                        name="ukuran"
                                        onkeyup="memorizeValue_ukuran(this.value)"
                                        value="{{ old('ukuran') }}"
                                    />
                                </div>
                                <button
                                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                                    onclick="hide_ukuran()"
                                    type="button"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="text-white w-5 h-5"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- {#each Array(elementukuranShowed) as _, i}
                        {/each} -->
                    </div>
                </div>
            </div>
            <div class="flex mt-1 items-center">
                <div>
                    <div>
                        <label for="" class="block">Kadar(%):</label>
                        <select name="kadar" id="kadar" class="input" onchange="generateNama()">
                            @foreach ($kadars as $kadar)
                            <option value="{{ $kadar->nama }}">{{ $kadar->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="ml-1">
                    <div>
                        <label for="" class="block">Berat(g):</label>
                        <input
                            id="berat" name="berat"
                            type="number"
                            class="input w-11/12"
                            placeholder="Berat"
                            onkeyup="generateNama()"
                            value="{{ old('berat') }}"
                            step="any"
                        />
                    </div>
                </div>
                {{-- ELEMENT - CAP --}}
                {{-- <item.cap :caps="$caps"></item.cap> --}}
                <div class="ml-1">
                    <label for="" class="block">Cap:</label>
                    <input id="input-cap" class="input w-11/12" type="text" name="cap" placeholder="Cap" onkeyup="select_cap(this.value)" value="{{ old('cap') }}"/>
                </div>
                <div class="ml-1">
                    <label for="" class="block">Kondisi:</label>
                    <select name="kondisi" id="kondisi" class="input" onchange="generateNama()">
                        <option value="">-</option>
                        @foreach ($kondisis as $kondisi)
                        <option value="{{ $kondisi->nama }}" {{ old('kondisi') === $kondisi['nama'] ? 'selected' : '' }}>{{ $kondisi->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex mt-1">
                <div>
                    <label for="">Ket.(opt.):</label>
                    <input type="text" class="input w-11/12" placeholder="Keterangan(opt.)" />
                </div>
                <div>
                    <label for="merek">Merek(opt.):</label>
                    <select name="merek" id="merek" class="input">
                        <option value="">--</option>
                        @foreach ($mereks as $merek)
                        <option value="{{ $merek->nama }}">{{ $merek->nama }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div>
                    <div>
                        <label for="" class="block">Stok:</label>
                        <input type="number" class="input w-11/12" name="stok" placeholder="Stok" step="1" value="{{ old('stok') }}"/>
                    </div>
                </div> --}}
            </div>
        </div>
    </template>
    <input type="hidden" name="gol_kadar" id="gol_kadar" value="{{ old('gol_kadar') }}">
    <input type="hidden" name="stok" id="stok" value=1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="text-pink-600">{{ $error }}</div>
    @endforeach
    @endif
    <div id="feedback_verifikasi" class="mt-1 hidden"></div>

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
        @if (session()->has('error_') && session('error_')!=="")
        <div class="alert-danger rounded">{{ session('error_') }}</div>
        @endif
        @if (session()->has('failed_') && session('failed_')!=="")
        <div class="alert-danger rounded">{{ session('failed_') }}</div>
        @endif
    </div>

    <div class="flex justify-center mt-1">
        <div id="div_found_item_photos" class="w-1/2 hidden">
            {{-- <item.photos></item.photos> --}}
        </div>
    </div>

    {{-- ELEMENT - PHOTOS --}}
    <div id="div_new_item_photos" class="mt-2 hidden">
        {{-- <item.photos></item.photos> --}}
        <div class="flex">
            @for ($i = 0; $i < 3; $i++)
                {{-- <div class="w-24 h-24{class_preview[i]}">
                    <img src="" alt="avatar_foto" />
                </div> --}}
                {{-- {:else} --}}
                @if ($i!==0)
                <div class="ml-2">
                @else
                <div>
                @endif
                    <div id="container-preview-photo-{{ $i }}" class="hidden">
                        <label for="input-photo-{{ $i }}">
                            <div class="w-24 h-24">
                                <img id="preview-photo-{{ $i }}" src="" alt="" class="w-full">
                            </div>
                        </label>
                        <button type="button" class="btn-danger rounded flex justify-center text-white mt-1 w-full" onclick="remove_photo('input-photo-{{ $i }}','container-preview-photo-{{ $i }}','preview-photo-{{ $i }}','label-choose-photo-{{ $i }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <label id="label-choose-photo-{{ $i }}" for="input-photo-{{ $i }}" class="border-8 border-dashed rounded w-24 h-24 flex items-center justify-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-16 h-16 text-slate-300"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z"
                            />
                        </svg>
                    </label>

                </div>
                <input id="input-photo-{{ $i }}" name="item_photo[]" type="file" accept=".jpg, .jpeg, .png" style="display:none" onchange="preview_photo(this.id,'container-preview-photo-{{ $i }}','preview-photo-{{ $i }}','label-choose-photo-{{ $i }}')"/>
            @endfor
        </div>
    </div>

    {{-- END - ELEMENT PHOTOS --}}
    <input type="hidden" name="found_kode_item" id="found_kode_item">
    <input type="hidden" name="found_item_id" id="found_item_id">
    <div class="mt-2">
        <button type="button" class="bg-emerald-500 py-4 rounded w-full text-center text-white font-bold flex items-center justify-center" onclick="cariItem()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
            <span>
                Cari & Verifikasi
            </span>
        </button>
    </div>
    <div id="div_btn_submit" class="mt-2"></div>
    {{-- ELEMENT - CODENAME --}}
    {{-- <item.codename :antings="$antings" :giwangs="$giwangs" :cincins="$cincins" :kalungs="$kalungs" :gelangrantais="$gelangrantais"
    :gelangbulats="$gelangbulats" :liontins="$liontins" :tipeperhiasans="$tipeperhiasans" :kodetipeperhiasans="$kodetipeperhiasans"
    :nomortipeperhiasans="$nomortipeperhiasans" :jenisperhiasans="$jenisperhiasans"></item.codename> --}}
    <div class="mt-1 border rounded p-1">
        <table>
            <tr>
                <th>Nama</th><th>:</th>
                <td id="td_nama_item">{{ old('nama') }}</td>
            </tr>
            <tr>
                <th>Specs</th><th>:</th>
                <td id="td_specs">{{ old('specs') }}</td>
            </tr>
            <tr>
                <th>KodeBrg</th><th>:</th>
                <td id="td_kode_item">{{ old('kode_item') }}</td>
            </tr>

        </table>
        <input type="hidden" name="nama" id="nama_item" value="{{ old('nama') }}" readonly>
        <input type="hidden" name="specs" id="specs" value={{ old('specs') }} readonly>
        <input type="hidden" name="kode_item" id="kode_item" value="{{ old('kode_item') }}" readonly>
    </div>
</form>

{{-- <status></-status> --}}

<script>
    const specs = {!! json_encode($specs, JSON_HEX_TAG) !!};
    const matas = {!! json_encode($matas,JSON_HEX_TAG) !!}
    const mainans = {!! json_encode($mainans,JSON_HEX_TAG) !!}
    const caps = {!! json_encode($caps, JSON_HEX_TAG) !!};

    let jenis_perhiasan=[];
    let label_matas=[];
    matas.forEach(mata => {
        label_matas.push({label:mata.nama,value:mata.nama,id:mata.id});
    });
    let count_child_mata=0;
    let dataMata=[];
    let label_mainans=[];
    mainans.forEach(mainan => {
        label_mainans.push({label:mainan.nama,value:mainan.nama,id:mainan.id});
    });
    let count_child_mainan=0;
    let data_mainan=[];
    let plat_before=0;
    let input_plat;
    let ukuran_before=0;
    let input_ukuran;
    let label_caps=[];
    caps.forEach(element => {
        label_caps.push({label:element.nama,value:element.nama,id:element.id});
    });
    // SET VARIABLE - JEDA BEBERAPA SAAT
    setTimeout(() => {
        input_plat = document.getElementById('input_plat');
        input_ukuran = document.getElementById('input_ukuran');
        setAutocomplete_cap();
    }, 1000);

    function setOpsiJenisPerhiasan(kode_tipe) {
        // console.log(kode_tipe);
        jenis_perhiasan = [];
        let results;
        if (kode_tipe!=='') {
            results=specs.filter(spec=>spec.kategori==='tipe_perhiasan'&&spec.kode_tipe===kode_tipe);
        }
        results.forEach(res => {
            jenis_perhiasan.push({
                label:res.nama,
                value:res.nama,
                id:res.id
            });
        });
        // console.log('jenis_perhiasan',jenis_perhiasan);
        generateNama();
        setAutocompleteJenisPerhiasan();
    }

    function setAutocompleteJenisPerhiasan() {
        $("#jenis_perhiasan").autocomplete({
            source: jenis_perhiasan,
            select: function(event, ui) {
                // console.log(ui.item);
                document.getElementById('jenis_perhiasan').value = ui.item.value;
                generateNama();
            }
        });

    }

    // FUNGSI UNTUK MATA
    function addMata() {
        count_child_mata++;
        dataMata[count_child_mata-1]={warna_mata:'',jumlah:1};
        generateElement();

    }

    function subtractMata(index) {
        count_child_mata--;
        dataMata.splice(index,1);
        generateElement();
        generateNama();
    }

    function generateElement() {
        let html_child_mata='';
        for (let i = 0; i < count_child_mata; i++) {
            html_child_mata+=`
            <div class="flex items-center mt-1">
                <div id="div-child-mata-${i}">
                    <input
                        id="input-warna-mata-${i}"
                        type="text"
                        placeholder="Warna"
                        class="input w-11/12 warna_mata"
                        name="warna_mata[]"
                        onkeyup="memorizeValue_mata(${i},'warna_mata',this.value)"
                        value="${dataMata[i].warna_mata}"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Jumlah"
                        class="input w-11/12 ml-1 jumlah_mata"
                        name="jumlah_mata[]"
                        onkeyup="memorizeValue_mata(${i},'jumlah',this.value)"
                        value="${dataMata[i].jumlah}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtractMata(${i})"
                    type="button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="text-white w-5 h-5"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                </button>
            </div>
            `;
        }
        document.getElementById('div-child-mata').innerHTML=html_child_mata;
        // console.log(html_child_mata);
        for (let i = 0; i < count_child_mata; i++) {
            setAutocomplete_mata(`input-warna-mata-${i}`,label_matas,i);
        }
    }

    function setAutocomplete_mata(id,source,index) {
        $(`#${id}`).autocomplete({
            source: source,
            select: function(event, ui) {
                dataMata[index].warna_mata=ui.item.value;
                document.getElementById(`${id}`).value = ui.item.value;
                generateNama();
            }
        });
    }

    function memorizeValue_mata(index, param, value) {
        if (param==='warna_mata') {
            dataMata[index].warna_mata=value;

        } else if (param==='jumlah') {
            dataMata[index].jumlah=value;
        }
        generateNama();
    }

    // FUNGSI UNTUK MAINAN

    function add_mainan() {
        count_child_mainan++;
        data_mainan[count_child_mainan-1]={mainan:'',jumlah:1};
        generateElement_mainan();

    }

    function subtract_mainan(index) {
        count_child_mainan--;
        data_mainan.splice(index,1);
        generateElement_mainan();
        generateNama();
    }

    function generateElement_mainan() {
        let html_child_mainan='';
        for (let i = 0; i < count_child_mainan; i++) {
            html_child_mainan+=`
            <div class="flex items-center mt-1">
                <div>
                    <input
                        id="input-mainan-${i}"
                        type="text"
                        placeholder="Mainan"
                        class="input w-11/12 mainan"
                        name="mainan[]"
                        onkeyup="memorizeValue_mainan(${i},'mainan',this.value)"
                        value="${data_mainan[i].mainan}"
                    />
                </div>
                <div>
                    <input
                        type="number"
                        placeholder="Jumlah"
                        class="input w-11/12 ml-1 jumlah_mainan"
                        name="jumlah_mainan[]"
                        onkeyup="memorizeValue_mainan(${i},'jumlah',this.value)"
                        value="${data_mainan[i].jumlah}"
                    />
                </div>
                <button
                    class="bg-red-400 rounded-full w-6 h-6 flex justify-center items-center"
                    onclick="subtract_mainan(${i})"
                    type="button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="text-white w-5 h-5"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                    </svg>
                </button>
            </div>
            `;
        }
        document.getElementById('div-child-mainan').innerHTML=html_child_mainan;
        // console.log(html_child_mainan);
        for (let i = 0; i < count_child_mainan; i++) {
            setAutocomplete_mainan(`input-mainan-${i}`,label_mainans, i);
        }
    }

    function setAutocomplete_mainan(id,source,index) {
        $(`#${id}`).autocomplete({
            source: source,
            select: function(event, ui) {
                data_mainan[index].mainan=ui.item.value;
                document.getElementById(`${id}`).value = ui.item.value;
                generateNama();
            }
        });
    }

    function memorizeValue_mainan(index, param, value) {
        if (param==='mainan') {
            data_mainan[index].mainan=value;
        } else if (param==='jumlah') {
            data_mainan[index].jumlah=value;
        }
        generateNama();
    }

    // FUNGSI - PLAT
    function show_plat() {
        document.getElementById('div-child-plat').classList.remove('hidden');
        if (input_plat.value==='') {
            input_plat.value = plat_before;
        }
    }

    function hide_plat() {
        document.getElementById('div-child-plat').classList.add('hidden');
        input_plat.value = null;
    }

    function memorizeValue_plat(value) {
        plat_before=value;
        generateNama();
    }

    // FUNGSI - UKURAN
    function show_ukuran() {
        document.getElementById('div-child-ukuran').classList.remove('hidden');
        if (input_ukuran.value==='') {
            input_ukuran.value = ukuran_before;
        }
    }

    function hide_ukuran() {
        document.getElementById('div-child-ukuran').classList.add('hidden');
        input_ukuran.value = null;
    }

    function memorizeValue_ukuran(value) {
        ukuran_before=value;
        generateNama();
    }

    // FUNGSI - CAP
    function setAutocomplete_cap(params) {
        $('#input-cap').autocomplete({
            source:label_caps,
            select: function (event,ui) {
                select_cap(ui.item.value);
            }
        });
    }

    function select_cap(value) {
        document.getElementById('input-cap').value=value;
    }
    // FUNGSI - PHOTO
    function preview_photo(input_id,container_preview_photo_id,preview_photo_id,label_choose_photo_id) {
        const el_input = document.getElementById(input_id);
        const el_container_preview_photo = document.getElementById(container_preview_photo_id);
        const el_preview_photo = document.getElementById(preview_photo_id);
        const el_label_choose_photo = document.getElementById(label_choose_photo_id);
        // console.log(el_input.files[0]);
        const blob = URL.createObjectURL(el_input.files[0]);
        el_preview_photo.src=blob;
        el_container_preview_photo.classList.remove('hidden');
        el_label_choose_photo.classList.add('hidden');
    }

    function remove_photo(input_id,container_preview_photo_id,preview_photo_id,label_choose_photo_id) {
        const el_input = document.getElementById(input_id);
        const el_container_preview_photo = document.getElementById(container_preview_photo_id);
        const el_preview_photo = document.getElementById(preview_photo_id);
        const el_label_choose_photo = document.getElementById(label_choose_photo_id);
        el_input.value=null;
        el_preview_photo.src=null;
        console.log(el_container_preview_photo);
        el_container_preview_photo.classList.add('hidden');
        el_label_choose_photo.classList.remove('hidden');
    }

    // FUNGSI - CODENAME
    const antings = {!! json_encode($antings,JSON_HEX_TAG) !!};
    const giwangs = {!! json_encode($giwangs,JSON_HEX_TAG) !!};
    const cincins = {!! json_encode($cincins,JSON_HEX_TAG) !!};
    const kalungs = {!! json_encode($kalungs,JSON_HEX_TAG) !!};
    const gelangrantais = {!! json_encode($gelangrantais,JSON_HEX_TAG) !!};
    const gelangbulats = {!! json_encode($gelangbulats,JSON_HEX_TAG) !!};
    const liontins = {!! json_encode($liontins,JSON_HEX_TAG) !!};
    const tipeperhiasans = {!! json_encode($tipeperhiasans,JSON_HEX_TAG) !!};
    const kodetipeperhiasans = {!! json_encode($kodetipeperhiasans,JSON_HEX_TAG) !!};
    const nomortipeperhiasans = {!! json_encode($nomortipeperhiasans,JSON_HEX_TAG) !!};
    const jenisperhiasans = {!! json_encode($jenisperhiasans,JSON_HEX_TAG) !!};

    let arr_warna_emas=[];
    let arr_warna_emas_id=[];
    let arr_tipe_barang=[];
    let arr_tipe_barang_id=[];
    let arr_range_usia=[];
    let arr_range_usia_id=[];
    let arr_mata=[];
    let arr_mata_id=[];
    let arr_mata_codename=[];
    let arr_mainan=[];
    let arr_mainan_id=[];
    let arr_mainan_codename=[];
    let arr_ukuran_id=[];
    let arr_ukuran_codename=[];
    let arr_cap=[];
    let arr_cap_id=[];
    let arr_cap_codename=[];
    let arr_kondisi=[];
    let arr_kondisi_id=[];
    let arr_kondisi_codename=[];
    let arr_kadar=[];
    let arr_kadar_id=[];
    let arr_kadar_codename=[];
    let arr_nampan_id=[];
    let arr_nampan_codename=[];
    setTimeout(() => {
        const ds_tipe_barang=specs.filter((element)=>element.kategori==='tipe_barang');
        // console.log(ds_tipe_barang);
        ds_tipe_barang.forEach(element => {
            arr_tipe_barang.push(element.nama);
            arr_tipe_barang_id.push(element.name_id);
        });
        // console.log(arr_tipe_barang,arr_tipe_barang_id);
        const data_warna_emass=specs.filter((element)=>element.kategori==='warna_emas');
        // console.log(data_warna_emass);
        data_warna_emass.forEach(element => {
            arr_warna_emas.push(element.nama);
            arr_warna_emas_id.push(element.name_id);
        });
        // console.log(arr_warna_emas,arr_warna_emas_id);
        const ds_range_usia=specs.filter((element)=>element.kategori==='range_usia');
        ds_range_usia.forEach(element => {
            arr_range_usia.push(element.nama);
            arr_range_usia_id.push(element.name_id);
        });
        // console.log(arr_range_usia,arr_range_usia_id);
        const ds_mata=specs.filter((element)=>element.kategori==='mata');
        ds_mata.forEach(element => {
            arr_mata.push(element.nama);
            arr_mata_id.push(element.name_id);
            arr_mata_codename.push(element.codename);
        });
        // console.log(arr_mata,arr_mata_codename);
        const ds_mainan=specs.filter((element)=>element.kategori==='mainan');
        ds_mainan.forEach(element => {
            arr_mainan.push(element.nama);
            arr_mainan_id.push(element.name_id);
            arr_mainan_codename.push(element.codename);
        });
        // console.log(arr_mainan,arr_mainan_codename);
        const ds_ukuran=specs.filter((element)=>element.kategori==='ukuran');
        ds_ukuran.forEach(element => {
            arr_ukuran_id.push(element.name_id);
            arr_ukuran_codename.push(element.codename);
        });
        // console.log(arr_ukuran_id,arr_ukuran_codename);
        const ds_cap=specs.filter((element)=>element.kategori==='cap');
        ds_cap.forEach(element => {
            arr_cap.push(element.nama);
            arr_cap_id.push(element.name_id);
            arr_cap_codename.push(element.codename);
        });
        // console.log(arr_cap,arr_cap_id,arr_cap_codename);
        const ds_kondisi=specs.filter((element)=>element.kategori==='kondisi');
        ds_kondisi.forEach(element => {
            arr_kondisi.push(element.nama);
            arr_kondisi_id.push(element.name_id);
            arr_kondisi_codename.push(element.codename);
        });
        // console.log(arr_kondisi,arr_kondisi_id,arr_kondisi_codename);
        const ds_kadar=specs.filter((element)=>element.kategori==='kadar');
        ds_kadar.forEach(element => {
            arr_kadar.push(element.nama);
            arr_kadar_id.push(element.name_id);
            arr_kadar_codename.push(element.codename);
        });
        // console.log(arr_kadar,arr_kadar_id,arr_kadar_codename);
        const ds_nampan=specs.filter((element)=>element.kategori==='nampan');
        ds_nampan.forEach(element => {
            arr_nampan_id.push(element.name_id);
            arr_nampan_codename.push(element.codename);
        });
        // console.log(arr_nampan_id,arr_nampan_codename);

    }, 1000);

    function generateNama() {
        // console.log(specs);
        const tipe_barang = document.getElementById('tipe_barang');
        const tipe_perhiasan = document.getElementById('tipe_perhiasan');
        const jenis_perhiasan = document.getElementById('jenis_perhiasan');
        const range_usia = document.getElementById('range_usia');
        const warna_emas = document.getElementById('warna_emas');
        const nampan = document.getElementById('nampan');
        const input_warna_matas = document.querySelectorAll('.warna_mata');
        const input_jumlah_matas = document.querySelectorAll('.jumlah_mata');
        const input_mainans = document.querySelectorAll('.mainan');
        const input_jumlah_mainans = document.querySelectorAll('.jumlah_mainan');
        const input_plat = document.getElementById('input-plat-0');
        const input_ukuran = document.getElementById('input-ukuran');

        const el_nama_item = document.getElementById('nama_item');
        const td_nama_item = document.getElementById('td_nama_item');
        const el_specs = document.getElementById('specs');
        const td_specs = document.getElementById('td_specs');
        const el_kode_item = document.getElementById('kode_item');
        const td_kode_item = document.getElementById('td_kode_item');

        const warna_matas = document.querySelectorAll('.warna_mata');
        const jumlah_matas = document.querySelectorAll('.jumlah_mata');

        const kadar = document.getElementById('kadar');
        const gol_kadar = document.getElementById('gol_kadar');
        const berat = document.getElementById('berat');
        const cap = document.getElementById('input-cap');
        const kondisi = document.getElementById('kondisi');

        // 1 - Tipe Barang
        let n_tipe_barang;
        let c_tipe_barang;
        if (tipe_barang.value==='Perhiasan') {
            c_tipe_barang='7';
            n_tipe_barang='';
        } else if (tipe_barang === 'LM') {
            c_tipe_barang='8';
            n_tipe_barang=' LM';
        } else {
            n_tipe_barang='tb.ERR';
            c_tipe_barang='400';
        }

        // 2 - Tipe Perhiasan
        let n_tipe_perhiasan;
        let c_tipe_perhiasan;
        if(kodetipeperhiasans.includes(tipe_perhiasan.value)){
            c_tipe_perhiasan=`${nomortipeperhiasans[kodetipeperhiasans.indexOf(tipe_perhiasan.value)]}`;
            n_tipe_perhiasan=tipe_perhiasan.value;
        } else {
            n_tipe_perhiasan=' tp.ERR';
            c_tipe_perhiasan='400';
        }

        // 3 - Range Usia
        let n_range_usia;
        let c_range_usia;
        if (arr_range_usia.includes(range_usia.value)) {
            n_range_usia = `ru.${range_usia.value}`;
            c_range_usia =`-${arr_range_usia_id[arr_range_usia.indexOf(range_usia.value)]}`;
        } else {
            n_range_usia = 'ru.ERR';
            c_range_usia = '-400';
        }

        // 4 - Jenis Perhiasan
        // console.log(jenisperhiasans);
        let n_jenis_perhiasan;
        let c_jenis_perhiasan;
        if (kodetipeperhiasans.includes(tipe_perhiasan.value)) {
            let list_jenis_perhiasan_d_tipe_perhiasan = jenisperhiasans.filter((element)=>element.kode_tipe===tipe_perhiasan.value);
            // console.log(list_jenis_perhiasan_d_tipe_perhiasan);
            let arr_jenis_perhiasan=[];
            list_jenis_perhiasan_d_tipe_perhiasan.forEach(element => {
                arr_jenis_perhiasan.push(element.nama);
            });
            if (arr_jenis_perhiasan.includes(jenis_perhiasan.value)) {
                n_jenis_perhiasan=` ${jenis_perhiasan.value}`;
                c_jenis_perhiasan=`${list_jenis_perhiasan_d_tipe_perhiasan[arr_jenis_perhiasan.indexOf(jenis_perhiasan.value)].name_id}`;
            } else {
                n_jenis_perhiasan = ' j.ERR';
                c_jenis_perhiasan = '400';
            }
        } else {
            n_jenis_perhiasan = ' j.ERR';
            c_jenis_perhiasan = '400';
        }

        // 5 - Warna Emas
        let n_warna_emas;
        let c_warna_emas;
        if (arr_warna_emas.includes(warna_emas.value)) {
            n_warna_emas = ` we.${warna_emas.value}`;
            c_warna_emas =`-${arr_warna_emas_id[arr_warna_emas.indexOf(warna_emas.value)]}`;
        } else {
            n_warna_emas = ' we.ERR';
            c_warna_emas = '-400';
        }

        // 6 - Mata


        let n_mata='';
        let s_mata='';
        let c_mata='';
        if (warna_matas.length!==0) {
            warna_matas.forEach((wama,i) => {
                if (arr_mata.includes(wama.value)) {
                    n_mata += ` ${arr_mata_codename[arr_mata.indexOf(wama.value)]}-${jumlah_matas[i].value}`;
                    c_mata +=`-${arr_mata_id[arr_mata.indexOf(wama.value)]}_${jumlah_matas[i].value}`;
                } else {
                    n_mata += ' m.ERR';
                    c_mata += '-400';
                }
            });
        } else {
            n_mata='';
            s_mata=' m.0';
            c_mata='-0';
        }

        // 7 - Mainan

        const mainans = document.querySelectorAll('.mainan');
        const jumlah_mainans = document.querySelectorAll('.jumlah_mainan');

        let n_mainan='';
        let s_mainan='';
        let c_mainan='';
        if (mainans.length!==0) {
            mainans.forEach((wama,i) => {
                if (arr_mainan.includes(wama.value)) {
                    n_mainan += ` ${arr_mainan_codename[arr_mainan.indexOf(wama.value)]}-${jumlah_mainans[i].value}`;
                    c_mainan +=`-${arr_mainan_id[arr_mainan.indexOf(wama.value)]}_${jumlah_mainans[i].value}`;
                } else {
                    n_mainan += ' mai.ERR';
                    c_mainan += '-400';
                }
            });
        } else {
            n_mainan='';
            s_mainan=' mai.0';
            c_mainan='-0';
        }

        // 8 - Plat
        const plat = document.getElementById('input_plat');
        let n_plat;
        let s_plat;
        let c_plat;
        if (plat!==null) {
            if (plat.value!==0) {
                n_plat=` pl.${plat.value}`;
                s_plat='';
                c_plat=`-${plat.value}`;
            } else {
                n_plat=' pl.ERR';
                s_plat=' pl.ERR';
                c_plat=`-400`;
            }
        } else {
            n_plat='';
            s_plat=' pl.0';
            c_plat='-0';
        }
        // console.log(plat);

        // 8 - Ukuran
        const ukuran = document.getElementById('input_ukuran');
        let n_ukuran;
        let s_ukuran;
        let c_ukuran;
        if (ukuran!==null) {
            let str_uk_value = ukuran.value.toString();
            // console.log(str_uk_value);
            // console.log(str_uk_value[0]);
            let s_uk='';
            for (let i = 0; i < str_uk_value.length; i++) {
                if (arr_ukuran_id.includes(parseInt(str_uk_value[i]))) {
                    s_uk+=arr_ukuran_codename[arr_ukuran_id.indexOf(parseInt(str_uk_value[i]))];
                } else {
                    s_uk+='ERR';
                }
            }
            n_ukuran='';
            s_ukuran=` uk.${s_uk}`;
            c_ukuran=`-${ukuran.value}`;
        } else {
            n_ukuran='';
            s_ukuran=' uk.0';
            c_ukuran='-0';
        }

        // 9 - Kadar
        let n_kadar;
        let s_kadar;
        let c_kadar;
        if (kadar===null || kadar.value==='') {
            n_kadar=' ERR%';
            s_kadar='';
            c_kadar='-400';
        } else {
            if (arr_kadar.includes(kadar.value)) {
                n_kadar=` ${arr_kadar[arr_kadar.indexOf(kadar.value)]}%`;
                s_kadar='';
                c_kadar=`-${arr_kadar[arr_kadar.indexOf(kadar.value)]}`;
            } else {
                n_kadar=' ERR%';
                s_kadar='';
                c_kadar='-400';
            }
        }
        // 10 - GOL. KADAR
        let gol_kadar_value;
        if (kadar.value < 70) {
            gol_kadar_value = 'MUDA';
        } else if (kadar.value < 90) {
            gol_kadar_value = 'BAGUS';
        } else if (kadar.value <= 100) {
            gol_kadar_value = 'TUA';
        }
        gol_kadar.value=gol_kadar_value;
        // console.log(gol_kadar.value);

        // 11 - Berat
        let n_berat;
        let s_berat;
        let c_berat;
        if (berat===null || berat.value==='' || berat.value == 0) {
            n_berat=' ERRg';
            s_berat='';
            c_berat='-400';
        } else {
            n_berat=` ${berat.value}g`;
            s_berat='';
            c_berat=`-${berat.value}`;
        }

        // 12 - Cap
        let s_cap;
        let c_cap;
        if (cap.value!=='') {
            if (arr_cap.includes(cap.value)) {
                s_cap = ` ${arr_cap_codename[arr_cap.indexOf(cap.value)]}`;
                c_cap =`-${arr_cap_id[arr_cap.indexOf(cap.value)]}`;
            } else {
                s_cap = ' c.ERR';
                c_cap = '-400';
            }
        } else {
            s_cap = ' c.-';
            c_cap = '-0';
        }

        // 13 - Kondisi
        let s_kondisi;
        let c_kondisi;
        if (kondisi.value!=='') {
            if (arr_kondisi.includes(kondisi.value)) {
                s_kondisi = ` ${arr_kondisi_codename[arr_kondisi.indexOf(kondisi.value)]}`;
                c_kondisi =`-${arr_kondisi_id[arr_kondisi.indexOf(kondisi.value)]}`;
            } else {
                s_kondisi = ' k.ERR';
                c_kondisi = '-400';
            }
        } else {
            s_kondisi = ' k.-';
            c_kondisi = '-0';
        }

        // 14 - NAMPAN
        let s_nampan;
        let c_nampan;
        if (nampan.value!=='') {
            if (arr_nampan_codename.includes(nampan.value)) {
                s_nampan = ` ${arr_nampan_codename[arr_nampan_codename.indexOf(nampan.value)]}`;
                c_nampan =`-${arr_nampan_id[arr_nampan_codename.indexOf(nampan.value)]}`;
            } else {
                s_nampan = ' n.ERR';
                c_nampan = '-400';
            }
        } else {
            s_nampan = ' n.-';
            c_nampan = '-0';
        }

        // PENETAPAN NAMA + CODE
        let nama_item=n_tipe_barang+n_tipe_perhiasan+n_jenis_perhiasan+n_mata+n_mainan+n_plat+n_ukuran+n_kadar+n_berat;
        let specs_item=n_range_usia+n_warna_emas+s_mata+s_mainan+s_plat+s_ukuran+s_kadar+s_berat+s_cap+s_kondisi+s_nampan;
        let codename_item=c_tipe_barang+c_tipe_perhiasan+c_jenis_perhiasan+c_range_usia+c_warna_emas+c_mata+c_mainan+c_plat+c_ukuran+c_kadar+c_berat+c_cap+c_kondisi+c_nampan;

        // console.log(tipeperhiasans)
        el_nama_item.value=nama_item;
        td_nama_item.textContent=nama_item;
        el_specs.value=specs_item;
        td_specs.textContent=specs_item;
        el_kode_item.value=codename_item;
        td_kode_item.textContent=codename_item;

    }

    // FUNGSI UNTUK PENCARIAN ITEM - IS ITEM EXIST

    const items = {!! json_encode($items,JSON_HEX_TAG) !!};
    const item_photos = {!! json_encode($item_photos, JSON_HEX_TAG) !!};
    // console.log(item_photos);
    function cariItem() {
        const kode_item = document.getElementById('kode_item').value;
        const div_feedback_verifikasi = document.getElementById('feedback_verifikasi');
        console.log(kode_item);
        let passed = false;
        if (kode_item==='' || kode_item.includes('400')) {
            div_feedback_verifikasi.classList.remove('hidden');
            div_feedback_verifikasi.classList.add('alert-danger');
            div_feedback_verifikasi.textContent = 'ERR: Kode Item!';
        } else {
            passed = true;
        }
        // console.log(passed);
        // console.log(kode_item);
        const div_btn_submit = document.getElementById('div_btn_submit');
        let found_items = [];
        let found_photos = [];
        let itemExist = false;
        if (passed) {
            found_items=items.filter((item)=>item.kode_item.indexOf(kode_item) > -1);
            // console.log(found_items);
            if (found_items.length !== 0) {
                div_feedback_verifikasi.classList.remove('hidden');
                div_feedback_verifikasi.classList.remove('alert-danger');
                div_feedback_verifikasi.classList.remove('alert-success');
                div_feedback_verifikasi.classList.add('alert-warning');
                div_feedback_verifikasi.textContent = 'WARN: Item sudah ada!';
                itemExist = true;
            } else {
                div_feedback_verifikasi.classList.remove('hidden');
                div_feedback_verifikasi.classList.remove('alert-danger');
                div_feedback_verifikasi.classList.remove('alert-warning');
                div_feedback_verifikasi.classList.add('alert-success');
                div_feedback_verifikasi.textContent = 'SUCC: Item belum ada!';
            }
        }

        if (passed) {
            if (itemExist) {
                // console.log(found_items[0]);
                // console.log(found_items[0].id);
                document.getElementById('found_kode_item').value=found_items[0].kode_item;
                document.getElementById('found_item_id').value=found_items[0].id;
                const div_found_item_photos = document.getElementById('div_found_item_photos');
                found_photos = item_photos.filter((el)=>el.item_id.toString().indexOf(found_items[0].id.toString()) > -1);
                let img_photos = '';
                found_photos.forEach(element => {
                    img_photos += `<img src="${window.location.origin}/storage/${element.path}" class="border-4 border-slate-300 rounded shadow box-shadow">`;
                });
                div_found_item_photos.innerHTML=img_photos;
                $('#div_found_item_photos').show(300);
                $(`#div_new_item_photos`).hide(300);
                // console.log(found_photos);
            } else {
                $(`#div_new_item_photos`).show(300);
                $('#div_found_item_photos').hide(300);
            }
        }

        if (passed) {
            const div_btn_submit = document.getElementById('div_btn_submit');
            div_btn_submit.innerHTML = `
            <button type="submit" class="bg-violet-500 py-4 rounded w-full text-white font-bold flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <span>+Tambah ke Cart</span>
            </button>
            `;
        }

    }
</script>
@endsection
