<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [FrontendCategoryController::class, 'show'])->name('categories.show');

Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
Route::middleware('auth')->prefix('reservations')->group(function () {
    Route::post('/', [FrontendReservationController::class, 'storesteptwo'])->name('reservations.store.steptwo');
    Route::get('/stepone', [FrontendReservationController::class, 'stepone'])->name('reservations.stepone');
    Route::post('/stepone', [FrontendReservationController::class, 'storestepone'])->name('reservations.store.stepone');
    Route::get('/steptwo', [FrontendReservationController::class, 'steptwo'])->name('reservations.steptwo');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/reservations', ReservationController::class);
});


require __DIR__ . '/auth.php';
