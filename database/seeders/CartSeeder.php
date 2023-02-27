<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = [
            [
                'user_id' => 3,
                'tipe_pelanggan' => 'customer',
                'pelanggan_id' => 5,
                'guest_id' => null,
            ]
        ];

        foreach ($carts as $cart) {
            $new_cart = Cart::create($cart);
            CartItem::create([
                'cart_id' => $new_cart->id,
                'item_id' => 1,
                'jumlah' => 1,
                'ongkos' => 10000,
                'harga' => 450000,
                'harga_total' => 2.2 * 450000,
            ]);
        }
    }
}
