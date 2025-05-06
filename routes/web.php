<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\NotBackAdminMiddleware;
use App\Http\Middleware\NotBackUserMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// GUEST ROUTES (dashboard admin)
Route::group(['middleware' => AdminMiddleware::class,'prefix' => 'dashboard'], function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('dashboard.login');
    Route::post('/login', [AdminController::class, 'login'])->name('dashboard.loginPost');
});

// AUTHENTICATED DASHBOARD ADMIN
Route::group(['middleware' => NotBackAdminMiddleware::class, 'prefix' => 'dashboard'], function () {
    Route::get('/home', [HomeController::class, 'dashboard'])->name('dashboard.home');
    Route::post("/logout", [AdminController::class, "logout"])->name("dashboard.logout");
    Route::resource('services',ServiceController::class)->names("dashboard.services");
    Route::get('reserve',[ReservationController::class,'index'])->name('dashboard.reservations.index');
    Route::get('reservations/{id}',[ReservationController::class,'edit'])->name('dashboard.reservations.edit');
    Route::put('reservations/{id}/status',[ReservationController::class,'updateStatus'])->name('dashboard.reservations.updateStatus');
});

// GUEST ROUTES (website user)
Route::group(['middleware' => UserMiddleware::class,'prefix' => 'website'], function () {
    Route::get('/register', [UserController::class, 'register'])->name('website.register');
    Route::post('/register', [UserController::class, 'registerPost'])->name('website.registerPost');
    Route::get('/login', [UserController::class, 'login'])->name('website.login');
    Route::post('/login', [UserController::class, 'loginPost'])->name('website.loginPost');
});

// AUTHENTICATED WEBSITE USER
Route::group(['middleware' => NotBackUserMiddleware::class, 'prefix' => 'website'], function () {
    Route::get('/home', [HomeController::class, 'website'])->name('website.home');
    Route::post("/logout", [UserController::class, "logout"])->name("website.logout");
    Route::post('reserve',[ReservationController::class,'store'])->name('website.reservation.store');
    Route::get('my-reservations',[ReservationController::class,'myReservations'])->name('website.reservation.myReservations');
    Route::delete('reserve/{service}',[ReservationController::class,'cancel'])->name('website.reservation.cancel');
});
