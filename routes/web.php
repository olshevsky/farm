<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\TicTacController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [AnimalController::class, 'index']);
    Route::resource('animals', AnimalController::class);
    Route::resource('farms', FarmController::class);
    Route::get('/tictac', [TicTacController::class, 'index'])->name('tictac.index');
});

require __DIR__.'/auth.php';
