<?php

use App\Http\Controllers\Articles\ArticlesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::resource('articles', ArticlesController::class);
    Route::put('/articles/{article}/approve', [ArticlesController::class, 'approve'])
        ->middleware(['can:approve,article'])->name("article.approve");

    Route::middleware(['can:restore,App\Models\Article'])->group(function () {
        Route::get('/article/trashed', [ArticlesController::class, 'trashed'])
            ->name('articles.trashed');
        Route::get('/articles/{article}/restore', [ArticlesController::class, 'restore'])
            ->name("article.restore");
    });

});
Route::get('/home', [HomeController::class, 'index'])->name('home');


