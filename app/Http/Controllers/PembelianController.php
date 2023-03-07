<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use App\Models\Pembelian;
use App\Models\PembelianItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelians = Pembelian::limit(100)->orderBy('created_at', 'desc')->get();
        $arr_pembelian_items = collect();
        foreach ($pembelians as $pembelian) {
            $pembelian_items = PembelianItem::where('pembelian_id', $pembelian->id)->get();
            $arr_pembelian_items->push($pembelian_items);
        }

        $data = [
            'goback' => 'home',
            'pembelians' => $pembelians,
            'arr_pembelian_items' => $arr_pembelian_items,
            'carts_data' => Cart::getCartsItemPerUser(),
        ];
        return view('pembelian.pembelians', $data);
    }

    public function konfirmasi_data_pelanggan(Request $request)
    {
        $post = $request->post();
        // dump($post);
        $phone = str_replace(' ', '', $post['phone']);
        $success_ = '';
        $errors_ = '';
        $pelanggan = null;
        if ($post['pembelian_sebagai'] === 'phone') {
            // CREATE TEMPORARY USER dari phone dan autogenerated password
            // CEK DULU APAKAH ADA phone yang sama?
            $pelanggan_same_kontak = User::where('phone', $phone)->first();
            // dd($pelanggan_same_kontak);
            if ($pelanggan_same_kontak !== null) {
                $errors_ .= 'Sudah ada user dengan nomor yang sama! Silahkan pilih Pelanggan sudah terdaftar/ter-registrasi!';
                return back()->with('errors_', $errors_);
            } else {
                $pelanggan = User::create([
                    'nama'=>'anonym',
                    'username'=>"0" . $phone,
                    'phone'=>$phone,
                    'password'=>bcrypt('anonym'),
                ]);
                $success_ .= 'User baru (temporary) berhasil dibuat!';
                session()->flash('success_',$success_);
            }
        }

        $cart = Cart::find($post['cart_id']);

        $data = [
            'pelanggan' => $pelanggan,
            'cart' => $cart,
            'goback' => 'pembelians.create',
            'previous_data' => $cart->id,
            'carts_data' => Cart::getCartsItemPerUser(),
            'pembelian_sebagai' => $post['pembelian_sebagai'],
        ];
        return view('pembelian.konfirmasi_data_pelanggan', $data);

    }

    // SIAP DIHAPUS - METHOD PEMBAYARAN
    // public function methode_pembayaran(Request $request)
    // {
    //     $post = $request->post();
    //     // dump($post);
    //     /**
    //      * Ini kan dari halaman konfirmasi data pelanggan.
    //      * Oleh karena itu maka disini di laksanakan step ubah cart->pelanggan_id ke user-id yang dipilih dari pelanggan baru / pelanggan terdaftar.
    //      *  */
    //     $success_ = '';
    //     $pelanggan = null;
    //     $cart = Cart::find($post['cart_id']);
    //     if ($post['pembelian_sebagai'] === 'phone' || $post['pembelian_sebagai'] === 'customer') {
    //         $cart->tipe_pelanggan = 'customer';
    //         $cart->pelanggan_id = $post['pelanggan_id'];
    //         $cart->guest_id = null;
    //         $cart->save();
    //         $success_ .= 'Guest telah diubah menjadi Customer.';
    //         session()->flash('success_',$success_);
    //         $pelanggan = User::find($cart->pelanggan_id);
    //     } else {
    //         session()->flash('warnings_','Lanjutkan sebagai Guest!');
    //     }
    //     $cart_items = CartItem::where('cart_id',$cart->id)->get();

    //     $data = [
    //         'goback' => 'pembelians.create',
    //         'previous_data' => $cart->id,
    //         'carts_data' => Cart::getCartsItemPerUser(),
    //         'pelanggan' => $pelanggan,
    //         'cart' => $cart,
    //         'cart_items' => $cart_items,
    //     ];
    //     return view('pembelian.methode_pembayaran', $data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $get = $request->query();
        // dd($get);
        $cart = Cart::find($get['cart_id']);
        $pelanggan = null;
        if ($cart->tipe_pelanggan === 'customer') {
            $pelanggan = User::find($cart->pelanggan_id);
        }
        $total_tagihan = 0;
        $cart_items = CartItem::where('cart_id', $cart->id)->get();
        foreach ($cart_items as $item) {
            $total_tagihan += $item->harga_total;
        }
        $data = [
            'goback'=>'carts.show',
            'previous_data'=>$get['cart_id'],
            'cart_id'=>$get['cart_id'],
            'carts_data'=>Cart::getCartsItemPerUser(),
            'cart'=>$cart,
            'pelanggan'=>$pelanggan,
            'cart_items'=>$cart_items,
            'total_tagihan'=>$total_tagihan,
        ];
        return view('pembelian.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $success_ = '';
        $post = $request->post();
        // dump((int)$post['total_bayar']);
        // dd($post);
        if ((int)$post['total_bayar'] < (int)$post['total_tagihan']) {
            $request->validate(['error'=>'required'],['error.required'=>'Total bayar tidak sesuai!']);
        }
        $cart = Cart::find($post['cart_id']);
        $pelanggan_nama = 'guest';
        if ($cart->pelanggan_id !== null) {
            $pelanggan_nama = $cart->pelanggan->nama;
        }
        $pembelian_new = Pembelian::create([
            'user_id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'pelanggan_id' => $cart->pelanggan_id,
            'pelanggan_nama' => $pelanggan_nama,
            'keterangan' => $cart->keterangan,
            'harga_total' => (int)$post['total_tagihan'],
            'total_bayar' => (int)$post['total_bayar'],
            'sisa_bayar' => (int)$post['sisa_bayar'],
        ]);
        $success_ .= 'Pembelian berhasil dibuat!';
        $cart_items = CartItem::where('cart_id', $cart->id)->get();
        foreach ($cart_items as $cart_item) {
            $item = Item::find($cart_item->item_id);
            $item->stok = $item->stok - $cart_item->jumlah;

            if ($item->stok <= 0) {
                $item->stok = 0;
            }
            $item->save();
            PembelianItem::create([
                'pembelian_id' => $pembelian_new->id,
                'item_id' => $cart_item->id,
                'item_nama' => $cart_item->item->nama,
                'jumlah' => $cart_item->jumlah,
                'ongkos' => $cart_item->ongkos,
                'harga' => $cart_item->harga,
                'harga_total' => $cart_item->harga_total,
            ]);
        }
        $success_ .= ' Items pembelian berhasil diinput! Stok diupdate!';

        // HAPUS CART
        $cart->delete();
        $success_ .= ' Cart dihapus!';
        return redirect()->route('pembelians.index')->with(['success_', $success_]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
