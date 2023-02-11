<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Spec;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::orderBy('kategori')->get();
        $data=[
            'items'=>$items
        ];
        return view('item.items',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specs=Spec::all();
        $antings = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Anting')->toArray());
        $giwangs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Giwang')->toArray());
        $cincins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Cincin')->toArray());
        $kalungs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Kalung')->toArray());
        $gelangrantais = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Gelang Rantai')->toArray());
        $gelangbulats = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Gelang Bulat')->toArray());
        $liontins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','Liontin')->toArray());
        $rangeusias = array_values($specs->where('kategori','range_usia')->toArray());
        $warnaemass = array_values($specs->where('kategori','warna_emas')->toArray());
        $nampans = array_values($specs->where('kategori','nampan')->toArray());
        $matas = array_values($specs->where('kategori','mata')->toArray());
        $mainans = array_values($specs->where('kategori','mainan')->toArray());
        $caps = array_values($specs->where('kategori','cap')->toArray());
        $kondisis = array_values($specs->where('kategori','kondisi')->toArray());
        // dd($gelangrantais);
        $data = [
            'specs'=>$specs,
            'antings'=>$antings,
            'giwangs'=>$giwangs,
            'cincins'=>$cincins,
            'kalungs'=>$kalungs,
            'gelangrantais'=>$gelangrantais,
            'gelangbulats'=>$gelangbulats,
            'liontins'=>$liontins,
            'rangeusias'=>$rangeusias,
            'warnaemass'=>$warnaemass,
            'nampans'=>$nampans,
            'matas'=>$matas,
            'mainans'=>$mainans,
            'caps'=>$caps,
            'kondisis'=>$kondisis,
        ];
        return view('item.tambah_item',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'item_photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        //    ]);
        $post = $request->post();
        dump($post);
        $file = $request->file();
        dd($file);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
