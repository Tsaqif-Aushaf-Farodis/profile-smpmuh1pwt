<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

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

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
   
    Route::get('/berita/{slug}', [HomeController::class, 'article'])->name('article');

    Route::post('/berita/{slug}/komentar', [CommentController::class, 'store'])
        ->name('article.comment.store')
        ->middleware('throttle:5,1');

    Route::get('/program/{slug}', [HomeController::class, 'program'])->name('program');

    Route::get('/prestasi/{slug}', [HomeController::class, 'prestasi'])->name('prestasi');

    Route::get('/{slug}', [HomeController::class, 'page'])->name('page');

    Route::get('/storage', [HomeController::class, 'createStorageLink'])->name('storage');
});


