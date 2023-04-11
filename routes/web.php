<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/todo', [App\Http\Controllers\TodoController::class, 'index'])->name('todo.index');
    Route::post('/todo', [App\Http\Controllers\TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/create', [App\Http\Controllers\TodoController::class, 'create'])->name('todo.create');
    Route::get('/todo/edit', [App\Http\Controllers\TodoController::class, 'edit'])->name('todo.edit');

    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
});

require __DIR__ . '/auth.php';