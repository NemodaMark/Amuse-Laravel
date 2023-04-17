<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/wallet',[App\Http\Controllers\HomeController::class, 'balance'])->name('wallet');
Route::post('/pay', [App\Http\Controllers\HomeController::class, 'pay'])->name('pay');
Route::get('/game',[App\Http\Controllers\HomeController::class, 'game'])->name('game');
Route::post('/gameupload', [App\Http\Controllers\Namespace\GameUploadController::class, 'gameUpload'])->name('gameupload');



