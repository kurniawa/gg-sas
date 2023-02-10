<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function create()
    {
        return view('pelanggans.create');
    }
}
