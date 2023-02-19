<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\ItemSpec;
use App\Models\Spec;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Item::getSpecs();
        $items = Item::all();
        $item_photos = ItemPhoto::all();
        $data+=array('goback'=>'home','items'=>$items, 'item_photos'=>$item_photos);
        // dd($data);
        return view('cart.carts-create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        // dd($files);
        // dd($files[1]);
        if ($files!==null) {
            foreach ($files as $file) {
                $photo_name="PP-". uniqid() . "." . $file->getClientOriginalExtension();
                // $path = Storage::putFileAs(
                //     'public/images/item_photos', $file, $photo_name
                // );
                $path=$file->storeAs('public/images/item-photos',$photo_name);
                $path = str_replace('public/','',$path); // aneh sih, path nya yang public mesti diilangin dulu, baru nanti bisa dipanggil pake asset
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
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
