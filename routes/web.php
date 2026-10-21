<?php
use App\Http\Controllers\{AdminController, CartController, HomeController, ProductController, ProfileController, UserDashboardController};
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{product}', [CartController::class, 'add']);
Route::patch('/cart/update/{id}', [CartController::class, 'update']);
Route::delete('/cart/remove/{id}', [CartController::class, 'remove']);

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::post('/checkout', [CartController::class, 'placeOrder']);
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::get('/products', [AdminController::class, 'products']);
    Route::post('/products', [AdminController::class, 'storeProduct']);
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct']);
    Route::put('/products/{product}', [AdminController::class, 'updateProduct']);
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct']);
    Route::get('/categories', [AdminController::class, 'categories']);
    Route::post('/categories', [AdminController::class, 'storeCategory']);
    Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/orders', [AdminController::class, 'orders']);
    Route::patch('/orders/{order}', [AdminController::class, 'updateOrder']);
});

require __DIR__ . '/auth.php';
