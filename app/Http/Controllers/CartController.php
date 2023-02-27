<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\ItemPhoto;
use App\Models\ItemSpec;
use App\Models\KadarHarga;
use App\Models\Spec;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function pilih_customer()
    {
        // $carts_unique = null;
        // if (count($carts)!==0) {
        //     $carts_unique = $carts->unique('pelanggan_id');
        // }
        // // dump($carts_unique);
        // // dump($carts_unique['A']);
        // // dump($carts_unique['A'][0]);
        // dump($carts);
        // dd($carts_unique);
        $carts_data = Cart::getCartsItemPerUser();
        // dd($carts_data['carts'][0]->items->pluck('id')[0]);
        // dump(CartItem::find(1));
        // dd(CartItem::find('1'));
        $data = [
            'goback'=>'home',
            'carts_data'=>$carts_data,
        ];
        // dd($data);
        return view('cart.pilih_customer', $data);
    }

    public function verifikasi_customer(Request $request)
    {
        $post = $request->query();
        $pelanggan = null;
        if ($post['pelanggan_id']!==null) {
            if ($post['username']!==null) {
                $pelanggan=User::where('id',$post['pelanggan_id'])->where('username',$post['username'])->first();
                if ($pelanggan === null) {
                    $request->validate(['error'=>'required'],['error.required'=>'Pelanggan tidak ditemukan!']);
                }
            } else {
                $pelanggan=User::where('id',$post['pelanggan_id'])->first();
                if ($pelanggan === null) {
                    $request->validate(['error'=>'required'],['error.required'=>'Pelanggan tidak ditemukan!']);
                }
            }
        } elseif ($post['username']!==null) {
            $pelanggan=User::where('username',$post['username'])->first();
            if ($pelanggan === null) {
                $request->validate(['error'=>'required'],['error.required'=>'Pelanggan tidak ditemukan!']);
            }
        } else {
            $request->validate(['error'=>'required'],['error.required'=>'Ada kesalahan input pelanggan!']);
        }
        $data = [
            'goback'=>'carts.pilih_customer',
            'carts_data'=>Cart::getCartsItemPerUser(),
            'pelanggan'=>$pelanggan,
            'tipe_pelanggan'=>$post['tipe_pelanggan'],
        ];
        return view('cart.verifikasi_customer', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->query());
        $post = $request->query();
        $pelanggan = null;
        $pelanggan_id = null;
        $guest_id = null;
        if ($post['tipe_pelanggan'] === 'customer') {
            $pelanggan = User::find($post['pelanggan_id']);
            $pelanggan_id = $pelanggan->id;
        } elseif ($post['tipe_pelanggan'] === 'guest') {
            $guest_id = $post['guest_id'];
        }
        $data = Item::getSpecs();
        $items = Item::all();
        $item_photos = ItemPhoto::all();
        $carts_data = Cart::getCartsItemPerUser();
        $data_to_append = [
            'goback'=>'carts.pilih_customer',
            'items'=>$items,
            'item_photos'=>$item_photos,
            'tipe_pelanggan'=>$post['tipe_pelanggan'],
            'pelanggan'=>$pelanggan,
            'pelanggan_id'=>$pelanggan_id,
            'guest_id'=>$guest_id,
            'carts_data'=>$carts_data,
        ];
        $data += $data_to_append;
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
        $post = $request->post();
        $feedback = [];
        $success_ = '';
        $failed_ = '';
        $is_item_exist = false;
        $is_new_item = false;
        if ($post['found_kode_item']!==null) {
            if ($post['found_kode_item']===$post['kode_item']) {
                $is_item_exist=true;
            } else {
                $request->validate(['error'=>'required'],['error.required'=>'Kode item tidak sama! Apakah Anda sempat mengubah form lalu submit tanpa melakukan verifikasi terlebih dahulu?']);
            }
        } else {
            $is_new_item = true;
        }

        $item_to_insert = null;

        if ($is_item_exist) {
            $item_to_insert = Item::find($post['found_item_id']);

        }

        if ($is_new_item) {
            $request->validate([
                'tipe_barang'=>'required',
                'item_photo' => 'array',
                'item_photo.*' => 'image|mimes:jpg,png,jpeg|max:2048',
            ]);

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
                    'stok'=>'required|numeric', // Pas insert ke Cart, ga perlu ada keterangan stok
                    'kode_item'=>'required|string',
                    'barcode'=>'nullable|numeric',
                    'keterangan'=>'nullable|string',
                ]);
            }
            // dump($post);
            // dd($file);
            // dd($post['warna_mata']);
            // dd($post);
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
            $barcode = null;
            if ($last_item===null) {
                $barcodes = Spec::where('kategori','barcode')->get();
                $gol_kadar = Spec::where('kategori','gol_kadar')->where('nama',$new_item->gol_kadar)->first();
                $barcode = $barcodes->where('kode_tipe',$new_item->tipe_perhiasan)->first()->nomor_tipe * 10000 + $gol_kadar->name_id;
                // dd($barcode);
                // $barcode = $barcode->nomor_tipe * 10000;
                $success_ .= " Belum ada tipe_perhiasan dengan gol_kadar yang sama! Barcode: $barcode";
            } else {
                $barcode = $last_item->barcode + 1;
                // dump($last_item->barcode);
                // dump($last_item->barcode++);
                // dump($last_item->barcode + 1);
                // dd((int)$last_item->barcode + 1);
                $success_ .= " Sudah ada barcode untuk tipe_perhiasan dan gol_kadar yang sama. Barcode: $barcode";
            }
            $new_item->barcode = $barcode;
            $new_item->save();
            $item_to_insert = $new_item;
            $success_ .= ' Barcode diupdate!';

        }

        // UPLOAD PHOTO - IF EXIST - dipindah di luar if diatas, karena tetep bisa upload foto meski item sudah ada.
        $files = $request->file('item_photo');
        // dd($files);
        // dd($files[1]);
        if ($files!==null) {
            foreach ($files as $file) {
                $photo_name="IP-". uniqid() . "." . $file->getClientOriginalExtension();
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
                    'item_id'=>$item_to_insert->id,
                    'path'=>$path
                ]);
            }
            $success_ .= ' Photo diupload!';
        }

        // $pelanggan_id = null;
        // if ($post['tipe_pelanggan'] === 'customer') {
        //     $pelanggan = User::find($post['pelanggan_id']);
        //     $pelanggan_id = $pelanggan->username;
        // } elseif ($post['tipe_pelanggan'] === 'guest') {
        //     $pelanggan_id = $post['pelanggan_id'];
        // }
        if ($item_to_insert === null) {
            // CEK SEKALI LAGI APAKAH ADA CART DENGAN PELANGGAN ATAU GUEST ID YANG SAMA
            $failed_ .= 'Ada kesalahan dalam penginputan item ke Cart!';
        } else {
            $cart_cek = Cart::where('user_id',Auth::user()->id)->where('pelanggan_id',$post['pelanggan_id'])->where('guest_id',$post['guest_id'])->first();
            // dd($post['guest_id']);
            $create_new_cart = false;
            if ($cart_cek !== null) {
                $create_new_cart = false;
            } else {
                $create_new_cart = true;
            }

            $cart_related = null;
            if ($create_new_cart) {
                $cart_related = Cart::create([
                    'user_id' => Auth::user()->id,
                    'tipe_pelanggan' => $post['tipe_pelanggan'],
                    'pelanggan_id' => $post['pelanggan_id'],
                    'guest_id' => $post['guest_id'],
                ]);
            } else {
                $cart_related = $cart_cek;
            }
            $kadar_harga = KadarHarga::where('kadar',$item_to_insert->kadar)->latest()->first();
            CartItem::create([
                'cart_id'=>$cart_related->id,
                'item_id'=>$item_to_insert->id,
                'ongkos'=>$kadar_harga->ongkos,
                'harga'=>$kadar_harga->harga,
                'harga_total'=>$kadar_harga->harga * $item_to_insert->berat,
            ]);
            $success_ .= ' Item berhasil diinput ke Cart!';
        }

        $feedback=[
            'success_'=>$success_,
            'failed_'=>$failed_,
        ];
        return back()->with($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        // dump($cart);
        // dd($cart->items);
        $pelanggan = null;
        $pelanggan_id = null;
        $guest_id = null;
        if ($cart->tipe_pelanggan === 'customer') {
            $pelanggan = User::find($cart->pelanggan_id);
            $pelanggan_id = $pelanggan->id;
        } else {
            $guest_id = $cart->guest_id;
        }

        $cart_items = CartItem::where('cart_id',$cart->id)->get();
        $kadar_hargas = [];
        foreach ($cart->items as $item) {
            $kadar_harga = KadarHarga::where('kadar',$item->kadar)->first();
            $kadar_hargas[] = $kadar_harga;
        }
        $data = [
            'goback'=>'home',
            'carts_data'=>Cart::getCartsItemPerUser(),
            'cart'=>$cart,
            'cart_items'=>$cart_items,
            'kadar_hargas'=>$kadar_hargas,
            'pelanggan'=>$pelanggan,
            'pelanggan_id'=>$pelanggan_id,
            'guest_id'=>$guest_id,
        ];
        return view('cart.show', $data);
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
