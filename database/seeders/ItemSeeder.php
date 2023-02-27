<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'tipe_barang' => 'Perhiasan',
                'tipe_perhiasan' => 'AT',
                'jenis_perhiasan' => 'Desy Polos',
                'range_usia' => 'dewasa',
                'warna_emas' => 'kuning',
                'plat' => null,
                'cap' => null,
                'ukuran' => null,
                'nampan' => null,
                'merek' => null,
                'kadar' => 30,
                'gol_kadar' => 'MUDA',
                'berat' => 2.2,
                'kondisi' => 99,
                'nama' => 'AT Desy Polos 30% 2g',
                'stok' => 1,
                'specs' => 'ru.dewasa we.kuning m.0 mai.0 pl.0 uk.0 c.- k.99 NONE',
                'kode_item' => '712-1-1-0-0-0-0-30-2-0-99-0',
                'barcode' => '10000',
                'keterangan' => null,
            ]
        ];

        foreach ($items as $item) {
            $new_item = Item::create($item);
            ItemPhoto::create([
                'item_id' => $new_item->id,
                'path' => 'images/item-photos/IP-63fc88c823c04.jpg'
            ]);
        }
    }
}
