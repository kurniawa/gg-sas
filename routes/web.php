<?php

// use App\Http\Controllers\CartController;
// use App\Http\Controllers\ItemController;
// use App\Http\Controllers\LoginController;
use App\Http\Livewire\Home;
// use App\Http\Controllers\PelangganController;
// use App\Http\Controllers\PembelianController;
use App\Http\Livewire\Items;
use App\Http\Livewire\Login\Login;
use App\Http\Livewire\Pembelians\Pembelians;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('app');
// });

// Route::controller(LoginController::class)->group(function(){
//     Route::get('/login','index')->name('login');
//     Route::post('/login','authenticate')->name('login');
//     Route::post('/logout','logout')->name('logout');
//     Route::get('/','home')->name('home');
// });

// Route::resource('items',ItemController::class)->middleware('auth');
// Route::resource('pelanggans',PelangganController::class)->middleware('admin');
// Route::resource('pembelians',PembelianController::class)->middleware('admin');
// Route::resource('carts',CartController::class)->middleware('admin');
// ITEMS
Route::get('/', Home::class)->middleware('auth')->name('home');
Route::controller(Login::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate')->name('login');
    Route::post('/logout','logout')->name('logout');
});
Route::get('/items', Items::class)->middleware('auth')->name('items');
Route::get('/pembelians', Pembelians::class)->middleware('auth')->name('pembelians');

