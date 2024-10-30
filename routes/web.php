<?php

use App\Http\Controllers\CarouselsController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/news', [NewsController::class,'index'])->name('getNews');
Route::get('/api/news/{id}', [NewsController::class,'show'])->name('getNewsDetail');


Route::get('/api/carousels', [CarouselsController::class,'index'])->name('getCarousels');

