<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\ItemSpec;
use App\Models\Spec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::orderBy('tipe_barang')->orderBy('nama')->get();
        $arr_item_photos=[];
        $item_matas=[];
        foreach ($items as $item) {
            $item_spec=ItemSpec::where('item_id',$item->id)->get();
            $item_photos=ItemPhoto::where('item_id',$item->id)->get();
            $arr_item_photos[]=$item_photos;
        }
        $data=[
            'items'=>$items,
            'arr_item_photos'=>$arr_item_photos
        ];
        // dd($data);
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
        $antings = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','ANTING')->toArray());
        $giwangs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GIWANG')->toArray());
        $cincins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','CINCIN')->toArray());
        $kalungs = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','KALUNG')->toArray());
        $gelangrantais = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GELANG-RANTAI')->toArray());
        $gelangbulats = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','GELANG-BULAT')->toArray());
        $liontins = array_values($specs->where('kategori','tipe_perhiasan')->where('tipe','LIONTIN')->toArray());
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
        $mereks=$specs->where('kategori','merek');
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
            'mereks'=>$mereks,
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

        if ($post['tipe_barang']==='Perhiasan') {
            $item=$request->validate([
                'tipe_barang'=>'required|string',
                'tipe_perhiasan'=>'required|string',
                'jenis_perhiasan'=>'required|string',
                'range_usia'=>'required|string',
                'warna_emas'=>'required|string',
                'plat'=>'nullable|numeric',
                'cap'=>'nullable|string',
                'ukuran'=>'nullable|numeric',
                'nampan'=>'nullable|string',
                'merek'=>'nullable|string',
                'kadar'=>'required|numeric',
                'gol_kadar'=>'required|string',
                'berat'=>'required|numeric',
                'kondisi'=>'nullable|string',
                'nama'=>'required|string',
                'specs'=>'required|string',
                'stok'=>'required|numeric',
                'kode_item'=>'required|string',
                'barcode'=>'nullable|numeric',
                'keterangan'=>'nullable|string',
            ]);
        }
        // dump($post);
        // dd($file);
        // dd($post['warna_mata']);
        // dd($post);
        $success_ = '';
        $new_item = Item::create($item);
        $success_.='Item baru berhasil diinput!';
        // UPDATE MATA - (IF EXIST)
        if (array_key_exists('warna_mata',$post)) {
            foreach ($post['warna_mata'] as $key=>$warna_mata) {
                $warna_mata=Spec::where('kategori','mata')->where('nama',$warna_mata)->first();
                ItemSpec::create([
                    'item_id'=>$new_item->id,
                    'spec_id'=>$warna_mata->id,
                    'kategori'=>$warna_mata->kategori,
                    'jumlah'=>$post['jumlah_mata'][$key]
                ]);
            }
            $success_.=' Mata diupdate!';
        }
        // UPDATE MAINAN - (IF EXIST)
        if (array_key_exists('mainan',$post)) {
            foreach ($post['mainan'] as $key=>$mainan) {
                $mainan=Spec::where('kategori','mainan')->where('nama',$mainan)->first();
                ItemSpec::create([
                    'item_id'=>$new_item->id,
                    'spec_id'=>$mainan->id,
                    'kategori'=>$mainan->kategori,
                    'jumlah'=>$post['jumlah_mainan'][$key]
                ]);
            }
            $success_.=' Mainan diupdate!';
        }
        // UPDATE BARCODE : update barcode berdasarkan tipe_perhiasan nya.
        $last_item = Item::where('tipe_perhiasan',$new_item->tipe_perhiasan)->where('gol_kadar',$new_item->gol_kadar)->where('id','!=',$new_item->id)->latest()->first();
        // dd($barcodes);
        // dd($last_item);
        if ($last_item===null) {
            $barcodes = Spec::where('kategori','barcode')->get();
            $gol_kadar = Spec::where('kategori','gol_kadar')->where('nama',$new_item->gol_kadar)->first();
            $barcode = $barcodes->where('kode_tipe',$new_item->tipe_perhiasan)->first()->nomor_tipe * 10000 + $gol_kadar->name_id;
            // dd($barcode);
            // $barcode = $barcode->nomor_tipe * 10000;
        } else {
            $barcode = $new_item->barcode++;
        }
        $new_item->barcode=$barcode;
        $new_item->save();
        $success_ .= ' Barcode diupdate!';

        // UPLOAD PHOTO - IF EXIST
        $files = $request->file('item_photo');
        // dd($files[1]);
        if (count($files)!==0) {
            foreach ($files as $file) {
                $photo_name="PP-". uniqid() . "." . $file->getClientOriginalExtension();
                // $path = Storage::putFileAs(
                //     'public/images/item_photos', $file, $photo_name
                // );
                // $path = str_replace('public/','',$path); // aneh sih, path nya yang public mesti diilangin dulu, baru nanti bisa dipanggil pake asset
                $path=$file->storeAs('public/images/item-photos',$photo_name);
                // $path = $file->storePubliclyAs(
                //     'images/item-photos',
                //     $photo_name,
                //     's3'
                // );
                ItemPhoto::create([
                    'item_id'=>$new_item->id,
                    'path'=>$path
                ]);
            }
            $success_.=' Photo diupload!';
        }
        $feedback=[
            'success_'=>$success_,

        ];

        return redirect()->route('items.index')->with($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        dd('show',$item);
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
        // dd('destroy', $item);
        $item_photos=ItemPhoto::where('item_id',$item->id)->get();
        $danger_='';
        if (count($item_photos)!==0) {
            // dump('Ada Foto yang perlu dihapus!');
            foreach ($item_photos as $item_photo) {
                Storage::delete($item_photo->path);
                // dump('Foto dihapus!');
            }
            $danger_.='Foto item dihapus!';
        }
        $item->delete();
        $danger_.=' Data item berhasil dihapus!';
        $feedback=[
            'danger_'=>$danger_,
        ];
        return back()->with($feedback);
    }
}
