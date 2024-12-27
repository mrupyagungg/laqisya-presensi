<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PembayaranGajiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GroupController;

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/presensi', [PresensiController::class, 'index']);

// Employees (CRUD)
Route::resource('employees', EmployeeController::class); // This automatically includes the POST route for 'store'
Route::resource('groups', EmployeeController::class); // This automatically includes the POST route for 'store'
Route::resource('pembayaran', PembayaranGajiController::class); // This automatically includes the POST route for 'store'

// Groups
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
Route::post('/group/store', [GroupController::class, 'store'])->name('group.store');


// Presensi
Route::get('/presensi', [PresensiController::class, 'index'])->name('presensi.index');
Route::post('/presensi', [PresensiController::class, 'store'])->name('presensi.store');

// Pembayaran
Route::get('/pembayaran', [PembayaranGajiController::class, 'index'])->name('pembayaran.index');