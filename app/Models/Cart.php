<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    static function getCartsItemPerUser()
    {
        if (User::isAdmin()) {
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            $usernames = [];
            $count_items = [];
            $arr_item_hargas = [];
            $arr_cart_items = [];
            foreach ($carts as $cart) {
                if ($cart->tipe_pelanggan === 'customer') {
                    $pelanggan = User::find($cart->pelanggan_id);
                    $usernames[] = $pelanggan->username;
                } else {
                    $usernames[] = $cart->guest_id;
                }
                $count_items[] = count($cart->items);

                // HARGA ITEM BERDASARKAN KADAR DIAMBIL DARI TABLE KADARHARGA
                $item_hargas = [];
                $cart_items = CartItem::where('cart_id',$cart->id)->get();
                foreach ($cart_items as $cart_item) {
                    $item = Item::find($cart_item->item_id);
                    if ($item->tipe_barang === 'Perhiasan') {
                        $kadar_harga = KadarHarga::where('kadar',$item->kadar)->latest()->first();
                        $item_hargas[] = [
                            'ongkos'=>$kadar_harga->ongkos,
                            'harga'=>$kadar_harga->harga,
                        ];
                    } else {
                        $item_hargas[] = null;
                    }
                    $cart_item_ids[] = $cart_item->id;
                }
                $arr_item_hargas[] = $item_hargas;
                $arr_cart_items[] = $cart_items;
            }

            $carts_data = [
                'carts'=>$carts,
                'usernames'=>$usernames,
                'count_items'=>$count_items,
                'arr_item_hargas'=>$arr_item_hargas,
                'arr_cart_items'=>$arr_cart_items,
            ];
        } else {
            $carts_data = [];
        }

        return $carts_data;
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'cart_items');
        // return $this->hasMany(Item::class);
    }

    public function pelanggan(): HasOne
    {
        return $this->hasOne(User::class,'id','pelanggan_id');
    }
}
