<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* 

    LOGIN & REGISTER
*/
Route::get('/login', [Controller::class, 'showLoginForm'])->name('login');
Route::get('/register', [Controller::class, 'showRegisterForm'])->name('register');

/* 
    ADMIN DASHBOARD
*/
Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('dashboard');

// USERS
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


/* 
    PENJUAL DASHBOARD
*/
// EVENTS
Route::get('/dashboard/events', [EventController::class, 'index'])->name('events');
Route::get('/dashboard/events/create', [EventController::class, 'create'])->name('event-create');
Route::post('/dashboard/events/create', [EventController::class, 'store'])->name('event-store');
// nanti tmbhin id ->          /edit/{id} untuk edit
Route::get('/dashboard/events/edit', [EventController::class, 'edit'])->name('event-edit');
Route::put('/dashboard/events/edit/{id}', [EventController::class, 'update'])->name('event-update');
// delete kalau misalnay tidak berikatan
Route::delete('/dashboard/events', [EventController::class, 'destroy'])->name('event-delete');
// nanti tmbhin id ->                   /{id} untuk detail
Route::get('/dashboard/event/detail', [EventController::class, 'show'])->name('event-detail');

// REKENING
Route::get('/dashboard/rekening', [RekeningController::class, 'index'])->name('rekening');
Route::get('/dashboard/rekening/create', [RekeningController::class, 'create'])->name('rekening-add');
Route::post('/dashboard/rekening/create', [RekeningController::class, 'store'])->name('rekening-store');
// nanti tmbhin id ->          /edit/{id} untuk edit
Route::get('/dashboard/rekening/edit', [RekeningController::class, 'edit'])->name('rekening-edit');
Route::put('/dashboard/rekening/edit/{id}', [RekeningController::class, 'update'])->name('rekening-update');
Route::delete('/dashboard/rekening', [RekeningController::class, 'destroy'])->name('rekening-delete');

/* 
    PEMBELI
*/
Route::get('/pembeli', function () {
   return view('pembeli.index');
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