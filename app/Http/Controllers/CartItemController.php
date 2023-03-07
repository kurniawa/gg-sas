<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    // public function update(Cart $cart, Item $item)
    // {
    //     dump('update');
    //     dump($cart);
    //     dd($item);
    // }
    public function update(Request $request, $cart_item_id)
    {
        $post = $request->post();
        $cart_item = CartItem::find($cart_item_id);
        $cart_item->ongkos = $post['ongkos'];
        $cart_item->harga = $post['harga'];
        $cart_item->harga_total = $post['harga_total'];
        $cart_item->save();
        return back()->with(['success_'=>'CartItem berhasil diupdate!']);
        // dump($post);
        // dd($cart_item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($cartItem_id, $item_id)
    {
        // dd($cartItem_id);
        $cartItem = CartItem::find($cartItem_id);
        $cartItem->delete();

        // CEK APAKAH $user ini masih punya $cart yang lain?

        $carts = Cart::where('user_id', Auth::user()->id)->get();
        if (count($carts) !== 0) {
            foreach ($carts as $cart) {
                if (count($cart->items) === 0) {
                    $cart->delete();
                }
            }
        }

        // // CEK APAKAH $carts UEBERHAUPT MASIH ADA DI DATABASE - KALAU TIDAK ADA MAKA TRUNCATE
        // $carts_all = Cart::all();
        // if (count($carts_all) === 0) {
        //     Cart::truncate();
        // }

        return back();
    }
}
