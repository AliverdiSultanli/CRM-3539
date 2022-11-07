<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
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
    return view('index');
})->name('home');

Route::resource('categories', CategoryController::class)->except(['show', 'destroy']);
Route::post('delete-category', [CategoryController::class, 'destroy'])->name('delete_category');

Route::resource('shops', ShopController::class)->except(['show', 'destroy']);
Route::post('delete-shop', [ShopController::class, 'destroy'])->name('delete_shop');
