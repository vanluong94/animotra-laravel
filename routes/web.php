<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserNotificationController;
use App\Models\Manga;
use App\View\Components\Profile;
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
    return view('app.home', [
        'featuredMangas'    => Manga::queryNewest()->limit(8)->get(),
        'latestMangas'      => Manga::queryLatest()->limit(8)->get(),
        'topRatedMangas'    => Manga::queryTopRated()->limit(8)->get(),
        'bestSellingMangas' => Manga::queryBestSelling()->limit(8)->get(),
    ]);
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

    Route::prefix('profile')->group(function(){
        Route::get( '/', [ ProfileController::class, 'profile' ])->name('profile');
        Route::post( 'update', [ ProfileController::class, 'update' ])->name('profile.update');
        Route::post( 'password', [ ProfileController::class, 'password' ])->name('profile.password');
        Route::get( 'comments', [ ProfileController::class, 'comments' ])->name('profile.comments');
        Route::get( 'notifications', [ ProfileController::class, 'notifications' ])->name('profile.notifications');
        Route::get( 'favorites', [ ProfileController::class, 'favorites' ])->name('profile.favorites');
        Route::get( 'read-later', [ ProfileController::class, 'readLater' ])->name('profile.readLater');
        Route::get( 'subscriptions', [ ProfileController::class, 'subscriptions' ])->name('profile.subscriptions');
        Route::get( 'topup', [ ProfileController::class, 'topupPage' ])->name('profile.topup.page');
        Route::post( 'topup', [ ProfileController::class, 'topup'])->name('profile.topup');
    });

    Route::get('notification/{id}', [ UserNotificationController::class, 'read' ])->name('notification.read');

    Route::post('{slug}/{chapter}/purchase', [ ChapterController::class, 'purchase' ])->name('chapter.purchase');
});
