<?php

use App\Http\Controllers\FacemarkController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\UserController;
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

    Route::get('/facemarks/create', [FacemarkController::class, 'create'])->name('facemarks.create');
    Route::post('/facemarks', [FacemarkController::class, 'store'])->name('facemarks.store');
    Route::delete('/facemarks/{ulid}', [FacemarkController::class, 'destroy'])->name('facemarks.destroy');
});

Route::get('/facemarks/{ulid}', [FacemarkController::class, 'show'])->name('facemarks.show');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{slug}', [UserController::class, 'show'])->name('users.show');

Route::post('/favorites/{id}', [FavoriteController::class, 'store'])->name('favorite.store');
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

Route::post('/follows/{id}', [FollowController::class, 'store'])->name('follow.store');
Route::delete('/follows/{id}', [FollowController::class, 'destroy'])->name('follow.destroy');

Route::view('/errors/204', 'errors.204')->name('errors.204');
Route::view('/errors/403', 'errors.403')->name('errors.403');
Route::view('/errors/404', 'errors.404')->name('errors.404');
Route::view('/errors/500', 'errors.500')->name('errors.500');

require __DIR__.'/auth.php';
