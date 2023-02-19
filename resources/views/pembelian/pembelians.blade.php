@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar :goback="$goback"></x-navbar>
<div class="p-2">
    <h3>+ Cart</h3>
</div>
<form method="post" action="{{ route('items.store') }}" class="m-2" enctype="multipart/form-data"
    x-data="{
        item:{
            tipe_barang:'Perhiasan',
        }
    }"
    >
    @csrf
    <div class="flex">
        <select id="tipe_barang" class="input" x-model="item.tipe_barang" name="tipe_barang" value="{{ old('tipe_barang') }}">
            <option value="">-</option>
            @foreach ($tipe_barangs as $tipe_barang)
            <option value="{{ $tipe_barang['tipe'] }}">{{ $tipe_barang['tipe'] }}</option>
            @endforeach
        </select>
        <template x-if="item.tipe_barang==='Perhiasan'">
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
                <div class="ml-1">
                    <input id="jenis_perhiasan" class="input w-full" type="text" name="jenis_perhiasan" placeholder="Jenis Perhiasan..." value="{{ old('jenis_perhiasan') }}"/>
                </div>
            </div>
        </template>
    </div>
    <template x-if="item.tipe_barang==='Perhiasan'">
        <div>
            <div class="flex mt-1 items-center">
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
            <x-item.mata :matas="$matas"></x-item.mata>

            <x-item.mainan :mainans="$mainans"></x-item.mainan>

            <div class="flex">
                <x-item.plat></x-item.plat>
                <x-item.ukuran></x-item.ukuran>
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
                <x-item.cap :caps="$caps"></x-item.cap>
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
                <div>
                    <div>
                        <label for="" class="block">Stok:</label>
                        <input type="number" class="input w-11/12" name="stok" placeholder="Stok" step="1" value="{{ old('stok') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <input type="hidden" name="gol_kadar" id="gol_kadar">
    {{-- <x-item.photos></x-item.photos> --}}
    @error('tipe_barang')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('tipe_perhiasan')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('jenis_perhiasan')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('range_usia')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('warna_emas')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('warna_mata')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('jumlah_mata')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('mainan')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('jumlah_mainan')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('nampan')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('plat')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('ukuran')
    <div class="text-pink-600">{{ $message }}</div>
    @enderror
    @error('kadar')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('berat')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('cap')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('kondisi')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('stok')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('merek')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('nama')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('specs')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('kode_item')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('keterangan')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="mt-2">
        <button type="submit" class="bg-violet-500 py-4 rounded w-full text-center text-white font-bold">
            +Tambah ke Stock
        </button>
    </div>
    <x-item.codename :antings="$antings" :giwangs="$giwangs" :cincins="$cincins" :kalungs="$kalungs" :gelangrantais="$gelangrantais"
    :gelangbulats="$gelangbulats" :liontins="$liontins" :tipeperhiasans="$tipeperhiasans" :kodetipeperhiasans="$kodetipeperhiasans"
    :nomortipeperhiasans="$nomortipeperhiasans" :jenisperhiasans="$jenisperhiasans"></x-item.codename>

    <button type="button" class="btn-warning" onclick="generateNama()">generateNama()</button>

</form>

<x-user-status></x-user-status>

<script>
    const specs = {!! json_encode($specs, JSON_HEX_TAG) !!};
    // console.log(specs);
    let jenis_perhiasan=[];
    // Data Mata
    const matas = {!! json_encode($matas,JSON_HEX_TAG) !!}
    // matas = matas.filter(function(){return true;});
    let label_matas=[];
    matas.forEach(mata => {
        label_matas.push({label:mata.nama,value:mata.nama,id:mata.id});
    });
    // console.log(matas);
    // console.log(matas.length);
    // console.log(label_matas);
    let count_child_mata=0;
    let dataMata=[];
    // Data Mainan
    const mainans = {!! json_encode($mainans,JSON_HEX_TAG) !!}
    // mainans = mainans.filter(function(){return true;});
    let label_mainans=[];
    mainans.forEach(mainan => {
        label_mainans.push({label:mainan.nama,value:mainan.nama,id:mainan.id});
    });
    // console.log(mainans);
    // console.log(mainans.length);
    // console.log(label_mainans);
    let count_child_mainan=0;
    let data_mainan=[];
    // Data Plat
    let plat_before=0;
    let input_plat;
    // Data Ukuran
    let ukuran_before=0;
    let input_ukuran;
    // Data Cap
    const caps = {!! json_encode($caps, JSON_HEX_TAG) !!};
    let label_caps=[];
    caps.forEach(element => {
        label_caps.push({label:element.nama,value:element.nama,id:element.id});
    });
    // SET VARIABLE - JEDA BEBERAPA SAAT
    setTimeout(() => {
        input_plat = document.getElementById('input_plat');
        input_ukuran = document.getElementById('input_ukuran')
    }, 1000);

    function setOpsiJenisPerhiasan(kode_tipe) {
        // console.log(kode_tipe);
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
        setAutocompleteJenisPerhiasan();
    }

    function setAutocompleteJenisPerhiasan() {
        $("#jenis_perhiasan").autocomplete({
            source: jenis_perhiasan,
            select: function(event, ui) {
                // console.log(ui.item);
                document.getElementById('jenis_perhiasan').value = ui.item.value;
            }
        });

    }
</script>
