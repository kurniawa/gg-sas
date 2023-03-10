<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Models\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app', ['carts_data'=>Cart::getCartsItemPerUser()]);
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate')->name('login');
    Route::post('/logout','logout')->name('logout');
    Route::get('/','home')->name('home');
});

// ITEMS
Route::resource('items',ItemController::class)->middleware('auth');
Route::resource('pelanggans',PelangganController::class)->middleware('admin');
Route::controller(PembelianController::class)->group(function ()
{
    Route::post('/pembelians/konfirmasi_data_pelanggan','konfirmasi_data_pelanggan')->name('pembelians.konfirmasi_data_pelanggan')->middleware('admin');
    Route::post('/pembelians/methode_pembayaran','methode_pembayaran')->name('pembelians.methode_pembayaran')->middleware('admin');
    // FOR TESTING
    Route::get('/pembelians/test_konfirmasi_data_pelanggan','test_konfirmasi_data_pelanggan')->name('pembelians.test_konfirmasi_data_pelanggan')->middleware('admin');
    Route::get('/pembelians/test_methode_pembayaran','test_methode_pembayaran')->name('pembelians.test_methode_pembayaran')->middleware('admin');
});
Route::resource('pembelians',PembelianController::class)->middleware('admin');
Route::controller(CartController::class)->group(function(){
    Route::get('/carts/pilih_customer','pilih_customer')->name('carts.pilih_customer')->middleware('admin');
    Route::get('/carts/verifikasi_customer','verifikasi_customer')->name('carts.verifikasi_customer')->middleware('admin');
    Route::post('/carts/update_customer','update_customer')->name('carts.update_customer')->middleware('admin');
});
Route::resource('carts',CartController::class)->middleware('admin');
Route::resource('carts.items',CartItemController::class)->middleware('admin');

// PENJUALAN
Route::controller(PenjualanController::class)->group(function(){
    Route::get('/penjualans','index')->name('penjualans.index')->middleware('admin');
    Route::get('/penjualans/pilih-tipe-surat','pilih_tipe_surat')->name('penjualans.pilih_tipe_surat')->middleware('admin');
    Route::get('/penjualans/create/surat-traditional','create_surat_traditional')->name('penjualans.create_surat_traditional')->middleware('admin');
    Route::get('/penjualans/create/input-no-surat-digital','input_no_surat_digital')->name('penjualans.input_no_surat_digital')->middleware('admin');
    Route::get('/penjualans/create/cek-surat-digital','cek_surat_digital')->name('penjualans.cek_surat_digital')->middleware('admin');
});
// use App\Http\Livewire\Auth;
// use App\Http\Livewire\Home;
// use App\Http\Livewire\Items;
// use App\Http\Livewire\Pembelians\Pembelians;
// // use App\Http\Livewire\Login\Login;

// Route::get('/', Home::class)->middleware('auth')->name('home');
// Route::get('/login', Auth::class)->middleware('guest')->name('login');
// Route::get('/logout', [Auth::class,'logout'])->name('logout');
// Route::get('/items', Items::class)->middleware('auth')->name('items');
// Route::get('/pembelians', Pembelians::class)->middleware('auth')->name('pembelians');

// // Route::get('/login', Login::class)->middleware('guest')->name('login');
// // Route::get('/logout', [Login::class,'logout'])->middleware('guest')->name('login');
// // Route::controller(Login::class)->group(function(){
// //     Route::get('/login', 'render')->name('login');
// //     Route::post('/login','authenticate')->name('login');
// //     Route::post('/logout','logout')->name('logout');
// // });
