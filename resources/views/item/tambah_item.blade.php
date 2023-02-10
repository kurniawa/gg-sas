@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar></x-navbar>
<div class="p-2">
    <h3>+Tambah Item</h3>
</div>
<form method="post" action="{{ route('items.store') }}" class="m-2" enctype="multipart/form-data"
    x-data="{
        item:{
            tipe_barang:'perhiasan',
            tipe_perhiasan:'',
            nampan:'NONE',
            mata:[],
        }
    }"
    >
    @csrf
    <div class="flex">
        <select class="input" x-model="item.tipe_barang" name="tipe_barang">
            <option value="">-</option>
            <option value="perhiasan">Perhiasan</option>
            <option value="LM">LM</option>
        </select>
        <template x-if="item.tipe_barang==='perhiasan'">
            <div class="ml-1 flex">
                <select
                    name="tipe_perhiasan"
                    x-model="item.tipe_perhiasan"
                    onchange="setOpsiJenisPerhiasan(this.value)"
                    class="input"
                >
                    <option value="">-</option>
                    <option value="AT">AT</option>
                    <option value="GW">GW</option>
                    <option value="CC">CC</option>
                    <option value="KL">KL</option>
                    <option value="GL">GL</option>
                    <option value="Lion">Lion</option>
                </select>
                @error('tipe_perhiasan')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="ml-1">
                    <input id="jenis_perhiasan" class="input w-full" type="text" name="jenis_perhiasan" placeholder="Jenis Perhiasan..."/>
                    <input type="hidden" name="jenis_perhiasan" />
                </div>
            </div>
        </template>
    </div>
    <template x-if="item.tipe_barang==='perhiasan'">
        <div>
            <div class="flex mt-1 items-center">
                <div>
                    <div>
                        <label for="" class="block">Range Usia:</label>
                        <select class="input" onchange="generatingNama()" name="range_usia">
                            <option value="">-</option>
                            @foreach ($range_usias as $range_usia)
                            <option value={{ $range_usia->nama }}>{{ $range_usia->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('range_usia')
                    <div class="text-pink-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ml-1">
                    <div>
                        <label for="" class="block">Warna Emas:</label>
                        <select class="input" on:change={generatingNama} name="warna_emas">
                            <option value="">-</option>
                            @foreach ($warna_emass as $warna_emas)
                            <option value={{ $warna_emas->nama }}>{{ $warna_emas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('warna_emas')
                    <div class="text-pink-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="ml-1">
                    <div>
                        <label for="" class="block">Nampan:</label>
                        <select class="input" on:change={generatingNama} name="nampan" x-bind:value="item.nampan">
                            @foreach ($nampans as $nampan)
                            <option value={{ $nampan->nama }}>{{ $nampan->codename }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('nampan')
                    <div class="text-pink-600">{{ $message }}</div>
                    @enderror
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
                        <input
                            type="number"
                            class="input w-11/12"
                            step="any"
                            placeholder="Kadar"
                            bind:value={item.kadar}
                            on:keyup={generatingNama}
                        />
                    </div>
                    @error('kadar')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <div>
                        <label for="" class="block">Berat(g):</label>
                        <input
                            type="number"
                            class="input w-11/12"
                            placeholder="Berat"
                            onkeyup="generatingNama()"
                            step="any"
                        />
                    </div>
                    @error('berat')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <x-item.cap :caps="$caps"></x-item.cap>
                <x-item.kondisi :kondisis="$kondisis"></x-item.kondisi>
            </div>
            <div class="flex mt-1">
                <div>
                    <label for="">Keterangan(opt.):</label>
                    <input type="text" class="input" placeholder="Keterangan(opt.)" />
                </div>
                <div>
                    <div>
                        <label for="" class="block">Stok:</label>
                        <input type="number" class="input w-11/12" placeholder="Stok" step="1" />
                    </div>
                    @error('stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </template>
    <x-item.photos></x-item.photos>
    <div class="mt-2">
        <button type="submit" class="bg-violet-500 py-4 rounded w-full text-center text-white font-bold">
            +Tambah ke Stock
        </button>
    </div>
    {{-- {#if item.tipe_barang === 'perhiasan'}
    {/if}
    <ItemPhoto />

    {#if show_main_feedback_success}
        <div class="mt-2 border rounded p-2 bg-emerald-50 text-emerald-500">
            {main_feedback}
        </div>
    {/if}
    {#if show_main_feedback_danger}
        <div class="mt-2 border rounded p-2 bg-pink-50 text-pink-500">
            {main_feedback}
        </div>
    {/if}

    {#if show_processing_animation}
        <div class="mt-2">
            <button
                type="button"
                class="bg-violet-300 py-2 rounded w-full text-white font-bold flex items-center justify-center"
                disabled
            >
                <span>+Tambah ke Stock</span>
                <img class="w-12 h-12" src={loading_gif_2} alt="loading animation" />
            </button>
        </div>
    {:else}
        <div class="mt-2">
            <button
                type="submit"
                class="bg-violet-500 py-4 rounded w-full text-center text-white font-bold"
            >
                +Tambah ke Stock
            </button>
        </div>
    {/if}
    {#if show_feedback}
        {#if feedback_form || feedback_nama || feedback_id}
            <div class="mt-2 border rounded p-2 bg-emerald-50 text-emerald-500">
                {#if feedback_form}
                    <div>Form Validation passed...</div>
                {/if}
                {#if feedback_nama}
                    <div>Item Name & Specs Validation passed...</div>
                {/if}
                {#if feedback_id}
                    <div>Item ID Validation passed...</div>
                {/if}
            </div>
        {/if}
        {#if !feedback_form || !feedback_nama || !feedback_id}
            <div class="mt-2 border rounded p-2 bg-pink-50 text-pink-500">
                {#if !feedback_form}
                    <div>Form Validation failed...</div>
                {/if}
                {#if !feedback_nama}
                    <div>Item Name & Specs Validation failed...</div>
                {/if}
                {#if !feedback_id}
                    <div>Item ID Validation failed...</div>
                {/if}
            </div>
        {/if}
    {/if}
    {#if feedback_photo.class !== ''}
        <div class={feedback_photo.class}>{feedback_photo.message}</div>
    {/if}
    <div class="mt-1 border rounded p-1">
        <table>
            <tr>
                <th>Nama</th><th>:</th>
                <td>{item.nama}</td>
            </tr>
            <tr>
                <th>Specs</th><th>:</th>
                <td>{item.specs}</td>
            </tr>
            <tr>
                <th>KodeBrg</th><th>:</th>
                <td>{item.kode_barang}</td>
            </tr>
        </table>
    </div> --}}
</form>

{{-- <button class="btn-danger rounded" on:click={consoleLogItem}>console.log(item)</button>
<button class="btn-danger rounded" on:click={consoleLogLogsValidasi}
    >console.log(logs_validasi)</button
>
<div class="mt-2">
    <button class="btn-danger rounded" on:click={() => console.log(file_input)}>file_input</button
    >
</div>
<div class="mt-2">
    <button class="btn-danger rounded" on:click={() => console.log(image_file)}>image_file</button
    >
</div>
<div class="mt-2">
    <button class="btn-danger rounded" on:click={() => console.log(haystack_kondisi)}
        >haystack_kondisi</button
    >
</div> --}}

<x-user-status></x-user-status>

<script>
    const specs = {!! json_encode($specs, JSON_HEX_TAG) !!};
    // console.log(specs);
    let jenis_perhiasan=[];
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
                $(".item-spec").hide();

                showItemSpecs(ui.item);
                // apply textContent
                document.getElementById("produk-id").textContent = ui.item.id;
                $("#tr-produk-id").show();
                document.getElementById("nama-tipe").textContent = ui.item.tipe;
                $("#tr-tipe").show();

                $("#produk-id").val(ui.item.id);
                $("#produk_id").val(ui.item.id);
                $("#produk-harga").val(ui.item.harga);
                document.getElementById("harga-pcs").textContent = `Rp ${formatHarga(ui.item.harga.toString())},-`;
                document.getElementById("tr-harga-pcs").style.display = 'table-row';
            }
        });

    }
</script>
