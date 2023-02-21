<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    static function getCartsItemPerUser()
    {
        $carts = Cart::where('user_id',Auth::user()->id)->get();
        $usernames = [];
        $count_items = [];
        foreach ($carts as $cart) {
            if ($cart->tipe_pelanggan === 'customer') {
                $pelanggan = User::find($cart->pelanggan_id);
                $usernames[] = $pelanggan->username;
            } else {
                $usernames[] = $cart->guest_id;
            }
            $count_items[] = count($cart->items);
        }

        $carts_data = [
            'carts'=>$carts,
            'usernames'=>$usernames,
            'count_items'=>$count_items,
        ];

        return $carts_data;
    }
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class, 'cart_items');
        // return $this->hasMany(Item::class);
    }
}
