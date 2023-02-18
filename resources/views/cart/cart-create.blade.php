@extends('layouts.main_layout')
@section('title','GL.SAS')
<x-navbar :goback="$goback"></x-navbar>
<div class="p-2">
    <h3>+Cart Item</h3>
</div>
<form method="post" action="{{ route('carts.store') }}" class="m-2" enctype="multipart/form-data">
    @csrf
    <label for="nama" class="block">Nama Item:</label>
    <input type="text" name="nama" id="nama" class="input w-full mt-1" placeholder="Nama Item..." onkeyup="searchItemByName(this.value)">
</form>
<div class="m-2">
    <table id="found-items" class="table-nice"></table>
</div>

<x-user-status></x-user-status>

<script>
    const items = {!! json_encode($items,JSON_HEX_TAG) !!}
    let item_namas=[];
    items.forEach(item => {
        item_namas.push(item['nama']);
    });
    console.log(items);
    console.log(item_namas);

    function searchItemByName(value) {
        // const found_items=items.filter((element)=>element.nama===value);
        if (value!=='') {
            let found_items = items.filter (element => element.nama.toLowerCase().indexOf(value) > -1);
            // console.log(value)
            // console.log(found_items);
            let html_found_items=''
            found_items.forEach(item => {
                html_found_items+=`
                <tr>
                    <td>${item.nama}</td>
                    <td>
                        <form method="POST" action="{{ route('carts.store') }}" class="m-0">
                            <button class="btn-emerald rounded" value="${item.id}" name="item_id">To Cart >></button>
                        </form>
                    </td>
                </tr>`;
            });
            document.getElementById('found-items').innerHTML=html_found_items;
        } else {
            document.getElementById('found-items').innerHTML='';
        }

        // const arrBirds = ["AT Desy 30% 2g", "Bald Eagle", 'Eurasian Collared-Dove'];

        // // Filter only strings with letters "ov".
        // let filtered = arrBirds.filter (arrBirds => arrBirds.includes('ov'));
        // console.log(filtered);
    }
</script>
