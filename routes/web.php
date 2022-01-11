<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;
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
require __DIR__.'/ajax.php';

/**
 * Manga Collections routes
 */
Route::prefix('collection')->group(function() {
    Route::get('{type}/{slug}', [ MangaCollectionController::class, 'view' ])->name('collection.view');
});

Route::prefix('manga')->group(function() {
    Route::get('all', [ MangaController::class, 'all' ])->name('manga.all');
    Route::get('{slug}', [ MangaController::class, 'view' ])->name('manga.view');
    Route::get('{slug}/{chapter}', [ ChapterController::class, 'view' ])->name('chapter.view');
});

Route::middleware('auth')->group(function(){
    Route::post( 'comment', [ CommentController::class, 'post' ] )->name('comment.post');
});
