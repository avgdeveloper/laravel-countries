<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
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

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', [CountryController::class, 'index'])
    ->middleware(['auth', 'verified','IpCheck'])->name('dashboard');

Route::middleware('auth','IpCheck')->group(function (){
    // Route::get('/', [CountryController::class, 'index'])->name('dashboard');
    Route::get('/', [CountryController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('countries')->group(function () {
        Route::post('new', [CountryController::class, 'store']);
        Route::post('update', [CountryController::class, 'update']);
        Route::get('destroy/{id}', [CountryController::class, 'destroy']);
      });
      
});

require __DIR__.'/auth.php';
