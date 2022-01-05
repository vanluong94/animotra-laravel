<?php

use App\Http\Controllers\Admin\MangaController;
use App\Http\Controllers\Admin\MangaCollectionController;
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
})->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

/**
 * Manga Collections routes
 */
Route::prefix('collection')->group(function() {
    Route::get('{type}/{slug}', [ MangaCollectionController::class, 'view' ])->name('collection.view');
});

Route::prefix('manga')->group(function() {
    Route::get('manga/{slug}', [ MangaController::class, 'view' ])->name('manga.view');
});
