<?php

use App\Http\Controllers\FacemarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopController;
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

Route::get('/', [TopController::class, 'index'])->name('top.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/facemarks/create', [FacemarkController::class, 'create'])->name('facemarks.create');
    Route::post('/facemarks', [FacemarkController::class, 'store'])->name('facemarks.store');
    Route::delete('/facemarks/{ulid}', [FacemarkController::class, 'destroy'])->name('facemarks.destroy');
});

require __DIR__.'/auth.php';
