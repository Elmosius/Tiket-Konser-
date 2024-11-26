<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [Controller::class, 'showLoginForm'])->name('login');
Route::get('/register', [Controller::class, 'showRegisterForm'])->name('register');

// Coba coba dlu buat liat viewnya
// ADMIN & PENJUAl DASHBOARD //
Route::get('/', function () {
    return view('admin.dashboard.index');
})->name('dashboard');

// USERS
Route::get('/dashboard/users', [UserController::class, 'index'])->name('users');
Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users-create');
// nanti tmbhin id ->          /edit/{id} untuk edit
Route::get('/dashboard/users/edit', [UserController::class, 'edit'])->name('users-edit');


// ROLES
Route::get('/dashboard/roles', function () {
    return view('admin.roles.index');
})->name('roles');

Route::get('/dashboard/roles/create', function () {
    return view('admin.roles.create');
})->name('roles-create');

// nanti /dashboard/roles/edit/{id} untuk edit
Route::get('/dashboard/roles/edit', function () {
    return view('admin.roles.edit');
})->name('roles-edit');


// PENJUAL DASHBOARD
// EVENTS
Route::get('/dashboard/events', function () {
    return view('penjual.events.index');
})->name('events');

Route::get('/dashboard/events/create', function () {
    return view('penjual.events.index');
})->name('events');




// REKENING
Route::get('/dashboard/rekening', function () {
    return view('penjual.rekening.index');
})->name('rekening');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';