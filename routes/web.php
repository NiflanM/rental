<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PayHereController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
route::get('/cars', [CarController::class, 'index'])->name('cars.index');
route::get('cars/create', [CarController::class, 'create'])->name('cars.create');
route::post('cars', [CarController::class, 'store'])->name('cars.store');
route::get('cars/{id}/edit',[CarController::class, 'edit'])->name('cars.edit');
route::put('cars/{id}',[CarController::class, 'update'])->name('cars.update');
route::delete('cars/{id}', [CarController::class, 'destroy'])->name('cars.destroy');
Route::patch('/cars/{car}/status',[CarController::class, 'updateStatus'])->name('cars.status');
});
route::get('/bookings', [BookingController::class,'index'])->name('bookings.index');
Route::get('/bookings/create/{car}', [BookingController::class,'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class,'store'])->name('bookings.store');
route::delete('/bookings/{id}',[BookingController::class,'destroy'])->name('bookings.destroy');
Route::patch('/bookings/{booking}/status',[BookingController::class, 'updateStatus'])->name('bookings.status');

Route::get('/', [HomeController::class,'welcome']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::patch('/admin/users/{user}/role', [UserController::class, 'updateRole'])
        ->name('admin.users.role');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.delete');
});

Route::get('/payhere/init/{booking}', [PayHereController::class, 'init'])
    ->name('payhere.init');
Route::post('/payhere/notify', [PayHereController::class, 'notify'])
    ->name('payhere.notify');

Route::get('/payhere/success', [PayHereController::class, 'success'])
    ->name('payhere.success');

    Route::get('/bookings/{booking}/edit',
    [BookingController::class, 'edit'])
    ->name('bookings.edit');

Route::put('/bookings/{booking}',[BookingController::class, 'update'])->name('bookings.update');

Route::patch('/bookings/{booking}/cancel',[BookingController::class,'cancel'])->name('bookings.cancel');

require __DIR__.'/auth.php';


