<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\CustomerProductsController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\CartController;

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

Route::get('/redirectAuthenticatedUsers', [RedirectAuthenticatedUsersController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// All shopping cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth', 'checkRole:user');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::put('/cart', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/{item}', [CartController::class, 'remove'])->name('cart.removeItem')->middleware('auth');
Route::delete('/cart', [CartController::class, 'removeAll'])->name('cart.removeAll')->middleware('auth');


