<?php

namespace Database\Seeders;

use App\Models\KadarHarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KadarHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kadar_hargas = [
            ["kadar"=>30,"ongkos"=>10000,"harga"=>450000],
            ["kadar"=>70,"ongkos"=>20000,"harga"=>800000],
            ["kadar"=>75,"ongkos"=>25000,"harga"=>850000],
        ];
        foreach ($kadar_hargas as $kadar_harga) {
            KadarHarga::create([
                'kadar' => $kadar_harga['kadar'],
                'ongkos' => $kadar_harga['ongkos'],
                'harga' => $kadar_harga['harga'],
            ]);
        }

        /**
         * kadar=>30,ongkos=>10000,harga=>450000
         * kadar=>70,ongkos=>20000,harga=>800000
         * kadar=>75,ongkos=>25000,harga=>850000
         */
    }
}
