<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
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

    $products = Product::with('images', 'category')->paginate(8);
//    $products = Product::get();
//    return $products->filter(function ($product) {
//        return $product->quantity < 2;
//    });
    $cartItems = Cart::content();
    $cartCount = Cart::count();
    //    return Product::with(['images', 'category', 'supplier'])->paginate(12);
    return view('welcome', compact('products', 'cartItems', 'cartCount'));
})->name('app');

Route::resource('books', \App\Http\Controllers\BookController::class);
Route::get('/books-data', [\App\Http\Controllers\BookController::class, 'pagination']);
Route::get('/search', [\App\Http\Controllers\BookController::class, 'search'])->name('books.search');

Route::get('/add-to-cart/{product}', [CartController::class, 'store'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart-remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/clear-cart', [CartController::class, 'clearCart'])->name('cart.clear');
Route::put('/cart-quantity-update/{id}', [CartController::class, 'incrementQuantity'])->name('cart.quantity.update');
Route::get('/cart-tax-update', [CartController::class, 'editTax'])->name('cart-tax-edit');
Route::post('/cart-tax-update', [CartController::class, 'updateTax'])->name('cart.updateTax');
Route::get('/checkout', function () {
    return view('store.checkout.index');
})->name('checkout');

Auth::routes();

Route::middleware('can:isAdmin')->prefix('/dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('products')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/show/{slug}', [ProductController::class, 'show'])->name('show');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::delete('delete/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });
});
