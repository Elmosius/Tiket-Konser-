<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Coba coba dlu buat liat viewnya
// ADMIN DASHBOARD //
Route::get('/', function () {
    return view('adm-dashboard.index');
})->name('dashboard');


// USERS
Route::get('/dashboard/users', function () {
    return view('adm-users.index');
})->name('users');

Route::get('/dashboard/users/create', function () {
    return view('adm-users.create');
})->name('users-create');   

// nanti /dashboard/users/edit/{id} untuk edit
Route::get('/dashboard/users/edit', function () {
    return view('adm-users.edit');
})->name('users-edit');   


// ROLES
Route::get('/dashboard/roles', function () {
    return view('adm-roles.index');
})->name('roles');

Route::get('/dashboard/roles/create', function () {
    return view('adm-roles.create');
})->name('roles-create');

// nanti /dashboard/roles/edit/{id} untuk edit
Route::get('/dashboard/roles/edit', function () {
    return view('adm-roles.edit');
})->name('roles-edit');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';