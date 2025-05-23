<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*

    LOGIN & REGISTER
*/
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [Controller::class, 'showRegisterForm'])->name('register');
Route::get('/', [PembelianController::class, 'index'])->name('pembeli-index');
Route::get('/pembeli/list',[PembelianController::class, 'show'])->name('pembeli-listTiket');
Route::post('/dashboard/register/users/create', [UserController::class, 'storeUser'])->name('user-store-register');

/*
    ADMIN DASHBOARD
*/

// USERS

Route::middleware(['auth',IsAdmin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('users');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('user-create');
    Route::post('/dashboard/users/create', [UserController::class, 'store'])->name('user-store');
    // nanti tmbhin id ->          /edit/{id} untuk edit
    Route::get('/dashboard/users/edit/{user}', [UserController::class, 'edit'])->name('user-edit');
    Route::post('/dashboard/users/edit/{user}', [UserController::class, 'update'])->name('user-update');
    Route::get('/dashboard/users/delete/{user}', [UserController::class, 'destroy'])->name('user-delete');
    
    // ROLES
    Route::get('/dashboard/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/dashboard/roles/create', [RoleController::class, 'create'])->name('role-create');
    Route::post('/dashboard/roles/create', [RoleController::class, 'store'])->name('role-store');
    // nanti /dashboard/roles/edit/{id} untuk edit
    Route::get('/dashboard/roles/edit/{role}', [RoleController::class, 'edit'])->name('role-edit');
    // nanti tmbhin id ->          /edit/{id} untuk edit
    Route::post('/dashboard/roles/edit/{role}', [RoleController::class, 'update'])->name('role-update');
    Route::get('/dashboard/roles/delete/{role}', [RoleController::class, 'destroy'])->name('role-delete');
    
});

Route::middleware('auth')->group(function () {
    /*
    PENJUAL DASHBOARD
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // EVENTS
    Route::get('/dashboard/events', [EventController::class, 'index'])->name('events');
    Route::get('/dashboard/events/create', [EventController::class, 'create'])->name('event-create');
    Route::post('/dashboard/events/store', [EventController::class, 'store'])->name('event-store');
    // nanti tmbhin id ->          /edit/{id} untuk edit
    Route::get('/dashboard/events/edit/{event}', [EventController::class, 'edit'])->name('event-edit');
    Route::post('/dashboard/events/edit/{event}', [EventController::class, 'update'])->name('event-update');
    // delete kalau misalnay tidak berikatan
    Route::get('/dashboard/events/{event}', [EventController::class, 'destroy'])->name('event-delete');
    // nanti tmbhin id ->                   /{id} untuk detail
    Route::get('/dashboard/event/{event}/detail', [EventController::class, 'show'])->name('event-detail');
    Route::get('/dashboard/events/{id}/status/update',[EventController::class,'statusUpdated'])->name('event-status-update');

    // REKENING
    Route::get('/dashboard/rekening', [RekeningController::class, 'index'])->name('rekening');
    Route::get('/dashboard/rekening/create', [RekeningController::class, 'create'])->name('rekening-add');
    Route::post('/dashboard/rekening/create', [RekeningController::class, 'store'])->name('rekening-store');
    // nanti tmbhin id ->          /edit/{id} untuk edit
    Route::get('/dashboard/rekening/edit/{rekening}', [RekeningController::class, 'edit'])->name('rekening-edit');
    Route::post('/dashboard/rekening/edit/{rekening}', [RekeningController::class, 'update'])->name('rekening-update');
    Route::get('/dashboard/rekening/{rekening}', [RekeningController::class, 'destroy'])->name('rekening-delete');
    Route::get('/dashboard/rekening/{id}/status/update',[RekeningController::class,'statusUpdated'])->name('rekening-status-update');
    /*
        PEMBELI
    */
    // Master 2
    Route::get('/pembeli/upcoming/detail/{event}',[PembelianController::class, 'create'])->name('upcoming.detail');
    // master 3
    Route::post('/pembeli/upcoming/detail/store',[PembelianController::class, 'store'])->name('simpan-pembelian');

    Route::get('pembeli/pemesanan',[PembayaranController::class, 'indexPembayaran'])->name('pemesanan-index');
    Route::get('history',[PembayaranController::class, 'index'])->name('history');
    Route::get('/pembeli/pemesanan/{pembelian}',[PembayaranController::class, 'create'])->name('pemesanan-create');
    Route::post('/pembeli/pemesanan/{pembelian}',[PembayaranController::class, 'update'])->name('pemesanan-update');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';