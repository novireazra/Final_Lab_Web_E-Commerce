<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Order_DetailsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

// Halaman Utama
Route::get('/', [HomeController::class, 'index']);

// Rute untuk Mulai Pesan
Route::get('/start-order', function () {
    return redirect()->route('login');
})->name('start-order')->middleware('guest');

// Rute untuk Review dan Pembayaran
Route::resource('reviews', ReviewController::class);
Route::resource('payments', PaymentController::class)->middleware('auth');
Route::resource('favorits', FavoritController::class)->middleware('auth');
Route::resource('order_details', Order_DetailsController::class)->middleware('auth');
Route::resource('orders', OrderController::class)->middleware('auth');
Route::resource('carts', CartController::class)->middleware('auth');
Route::resource('menus', MenuController::class)->middleware('auth');
Route::resource('restaurants', RestaurantController::class)->middleware('auth');

// Rute untuk Membuat Restoran (Hanya untuk seller)
Route::get('/seller/restaurants/create', [RestaurantController::class, 'create'])
    ->middleware('role:seller')
    ->name('restaurants.create');

Route::middleware(['auth', 'verified'])->group(function () {
    // Seller Routes
    Route::get('/seller/orders', [OrderController::class, 'sellerOrders'])->name('seller.orders');
    Route::patch('/seller/orders/{order}/status', [OrderController::class, 'updateOrderStatus'])
        ->name('seller.orders.update-status');
});

// Rute untuk Favorit
Route::post('/favorit/add', [FavoritController::class, 'add'])->name('favorit.add')->middleware('auth');

// Rute untuk Checkout
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/checkoutAll', [CartController::class, 'checkoutAll'])->name('cart.checkoutAll');

// Rute untuk Admin dan User
Route::resource('admin', UserController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');

// Rute untuk Home Admin
Route::get('/admin/home', [RestaurantController::class, 'adminHome'])->name('admin.home');

// Rute untuk Menampilkan Restoran
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::post('/restaurants/store', [RestaurantController::class, 'store'])->name('restaurants.store');

Route::middleware(['auth'])->group(function () {
    // Cart Routes
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Rute untuk Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rute Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Otentikasi
require __DIR__ . '/auth.php';