<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
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

Route::get('/', function () {
    return view('app');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','index')->name('login');
    Route::post('/login','authenticate')->name('login');
    Route::post('/logout','logout')->name('logout');
});

Route::resource('items',ItemController::class)->middleware('auth');
Route::resource('pelanggans',PelangganController::class)->middleware('auth');
