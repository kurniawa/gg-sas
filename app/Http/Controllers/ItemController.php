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
        $tipe_barangs = array_values($specs->where('kategori','tipe_barang')->toArray());
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
        $kondisis = $specs->where('kategori','kondisi');
        $tipejeniss=array_values($specs->where('kategori','tipe_perhiasan')->groupBy('tipe')->toArray());
        $tipeperhiasans=[];
        $kodetipeperhiasans=[];
        $nomortipeperhiasans=[];
        for ($i=0; $i < count($tipejeniss); $i++) {
            $tipeperhiasans[]=$tipejeniss[$i][0]['tipe'];
            $kodetipeperhiasans[]=$tipejeniss[$i][0]['kode_tipe'];
            $nomortipeperhiasans[]=$tipejeniss[$i][0]['nomor_tipe'];
        }
        $jenisperhiasans=array_values($specs->where('kategori','tipe_perhiasan')->toArray());
        $kadars=$specs->where('kategori','kadar');
        // dd($tipeperhiasans);
        // dd($gelangrantais);
        $data = [
            'specs'=>$specs,
            'tipe_barangs'=>$tipe_barangs,
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
            'tipeperhiasans'=>$tipeperhiasans,
            'kodetipeperhiasans'=>$kodetipeperhiasans,
            'nomortipeperhiasans'=>$nomortipeperhiasans,
            'jenisperhiasans'=>$jenisperhiasans,
            'kadars'=>$kadars,
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
        $request->validate([
            'tipe_barang'=>'required',
            'item_photo' => 'array',
            'item_photo.*' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $post = $request->post();
        $file = $request->file();

        if ($post['tipe_barang']==='Perhiasan') {
            $item=$request->validate([
                'tipe_barang'=>'required|string',
                'tipe_perhiasan'=>'required|string',
                'jenis_perhiasan'=>'required|string',
                'plat'=>'nullable|numeric',
                'cap'=>'nullable|string',
                'ukuran'=>'nullable|numeric',
                'nampan'=>'nullable|string',
                'merek'=>'nullable|string',
                'kadar'=>'required|numeric',
                'berat'=>'required|numeric',
                'kondisi'=>'nullable|string',
                'nama'=>'required|string',
                'specs'=>'required|string',
                'stok'=>'required|numeric',
                'kode_item'=>'required|string',
                'barcode'=>'required|numeric',
                'keterangan'=>'nullable|string',
            ]);
            // $item_mata = $request->validate([
            //     'warna_mata'=>'nullable|array',
            //     'jumlah_mata'=>'nullable|array',
            //     'warna_mata.*'=>'string',
            //     'jumlah_mata.*'=>'numeric',
            // ]);
            // $item_mainan = $request->validate([
            //     'mainan'=>'nullable|array',
            //     'jumlah_mainan'=>'nullable|array',
            //     'mainan.*'=>'string',
            //     'jumlah_mainan.*'=>'numeric',
            // ]);
        }
        dump($post);
        dd($file);
        $new_item = Item::create($item);
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
