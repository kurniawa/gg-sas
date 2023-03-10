<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::all();
        $data = [
            'goback' => 'home',
            'penjualans' => $penjualans,
            'carts_data' => Cart::getCartsItemPerUser()
        ];
        return view('penjualans.index', $data);
    }

    public function pilih_tipe_surat()
    {
        $data = [
            'goback' => 'penjualans.index',
            'carts_data' => Cart::getCartsItemPerUser()
        ];

        return view('penjualans.pilih-tipe-surat', $data);
    }

    public function create_surat_traditional()
    {
        $data = [
            'goback' => 'penjualans.pilih_tipe_surat',
            'carts_data' => Cart::getCartsItemPerUser()
        ];

        return view();
    }

    public function input_no_surat_digital()
    {
        $data = [
            'goback' => 'penjualans.pilih_tipe_surat',
            'carts_data' => Cart::getCartsItemPerUser()
        ];
        return view('penjualans.input-no-surat-digital', $data);
    }

    public function cek_surat_digital(Request $request)
    {
        $request->validate([
            'no_surat'=>'required'
        ]);
        $get = $request->query();
        $pembelian = Pembelian::where('no_surat',$get['no_surat'])->first();
        if ($pembelian === null) {
            return back()->with('errors_', 'Surat Pembelian tidak ditemukan! Apakah ada kesalahan dalam pengetikan?');
        } else {

        }
    }
}
