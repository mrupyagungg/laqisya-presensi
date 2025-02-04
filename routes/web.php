<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PembayaranGajiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;

// Halaman Utama dan Login
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Presensi
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::get('/presensi/absen', [PresensiController::class, 'index'])->name('presensi.absen');
Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');

// Employees (CRUD)
Route::resource('employees', EmployeeController::class);

// Groups (CRUD)
Route::resource('groups', GroupController::class);

// Pembayaran Gaji (CRUD)
Route::get('/get-basic-salary/{id}', [PembayaranGajiController::class, 'getBasicSalary'])->name('pembayaran.getBasicSalary');
Route::resource('pembayaran', PembayaranGajiController::class);
Route::post('/pembayaran', [PembayaranGajiController::class, 'store'])->name('pembayaran.store');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/index2', [DashboardController::class, 'index2'])->name('dashboard.index2');
    Route::get('/dashboard/presensi', [PresensiController::class, 'index'])->name('dashboard.presensi');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
