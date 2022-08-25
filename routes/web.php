<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
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
Route::post('/add-to-cart/{productid}', [CartController::class, 'addToCart'])->name('post.cart');
Route::post('/remove-from-cart/{index}', [CartController::class, 'removeFromCart'])->name('remove.cart');

Route::post("/login", [AuthController::class, 'login'])->name('login.user');
Route::post("/register", [AuthController::class, 'register'])->name("register.user");
Route::post("/logout", [AuthController::class, 'logout'])->name("logout.user");

Route::middleware('customer.gues')->group(function () {
    Route::get('/login', [AuthController::class, 'indexLogin'])->name('view.login');
    Route::get('/register', [AuthController::class, 'indexRegister'])->name('view.register');
});

Route::middleware("customer")->group(function () {
    Route::get("/", function () {
        return view('pages.home');
    })->name('view.home');
    Route::get("/profile", [ProfileController::class, 'index'])->name('view.profile');
    Route::get("/shop", [ShopController::class, 'index'])->name("view.shop");
    Route::get("/tocart/{productid}", [CartController::class, 'indexAddToCart'])->name('view.add-to-cart');
    Route::get("/cart", [CartController::class, 'indexCart'])->name('view.cart');
    Route::get("/history-transaction", [HistoryController::class, 'index'])->name("view.history-trx");

    Route::post('/update-profile', [ProfileController::class, 'update'])->name('update.profile');
    Route::post('/order', [CartController::class, 'order'])->name('post.order');
});
