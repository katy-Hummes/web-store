<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Vendedor
    Route::get('criar-produto', [SellerController::class, 'create'])->name('create.product');
    Route::post('criar-produto', [SellerController::class, 'store'])->name('store.product')->middleware(HandlePrecognitiveRequests::class);
    Route::get('loja-vendedor/{id}', [SellerController::class, 'show'])->name('show.seller');
    Route::put('editar-produto/{id}', [SellerController::class, 'update'])->name('update.product');
    Route::delete('deletar-produto/{id}', [SellerController::class, 'destroy'])->name('destroy.product');

    // Cliente
    Route::get('/products', [ProductController::class, 'products'])->name('products');
    route::get('/produto/{id}', [ProductController::class, 'show'])->name('show.product');
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
});
