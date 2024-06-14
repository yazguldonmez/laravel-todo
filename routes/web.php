<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('home');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Route::resource('tasks', TaskController::class)->middleware('auth');

Route::middleware('auth')->prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index'])
        ->name('tasks.index');
    Route::get('/create', [TaskController::class, 'create'])
        ->name('tasks.create');
    Route::post('/create', [TaskController::class, 'store'])
        ->name('tasks.store');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');
    Route::put('/{id}/update', [TaskController::class, 'update'])
        ->name('tasks.update');
    Route::get('/{id}/delete', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');
    Route::post('/{id}/updateStatus', [TaskController::class, 'destroy'])
        ->name('tasks.updateStatus');
});
