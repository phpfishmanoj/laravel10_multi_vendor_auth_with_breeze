<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\SellerController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ----------------------- Admin Route ----------------------- */

//sellerMiddleware
Route::prefix('seller')->group(
    function () {
        Route::get('/login', [SellerController::class, 'Index'])->name('seller_login_form');
        Route::post('/login/asseller', [SellerController::class, 'Login'])->name('seller.seller_login');
        Route::get('/dashboard', [SellerController::class, 'Dashboard'])->name('seller.seller_dashboard')->middleware('sellerMiddleware');
        Route::get('/logout/asseller', [SellerController::class, 'Logout'])->name('seller.seller_logout')->middleware('sellerMiddleware');;
        Route::get('/register/asseller', [SellerController::class, 'Register'])->name('seller.seller_register_form');
        Route::post('/seller/registerSeller', [SellerController::class, 'RegisterProcess'])->name('seller.seller_register');
    }
);

//adminMiddleware
Route::prefix('admin')->group(
    function () {
        Route::get('/login', [AdminController::class, 'Index'])->name('admin_login_form');
        Route::post('/login/asadmin', [AdminController::class, 'Login'])->name('admin.login');
        Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('adminMiddleware');
        Route::get('/logout/asadmin', [AdminController::class, 'Logout'])->name('admin.logout')->middleware('adminMiddleware');
        Route::get('/register/asadmin', [AdminController::class, 'Register'])->name('admin.register_form');
        Route::post('/admin/registerAdmin', [AdminController::class, 'RegisterProcess'])->name('admin.register');
    }
);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
