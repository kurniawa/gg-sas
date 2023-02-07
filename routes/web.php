<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
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
    Route::get('/login','index')->name('Login');
    Route::post('/login','authenticate')->name('Login');
    Route::post('/logout','logout')->name('Logout');
});

Route::controller(ItemController::class)->group(function(){
    Route::get('/items','index')->name('Items')->middleware('auth');
    Route::get('/tambah-item','tambah_item')->name('TambahItem')->middleware('auth');
    Route::post('/tambah-item','tambah_item')->name('TambahItem')->middleware('auth');
});
