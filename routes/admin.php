<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ChapterAjaxController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MangaController;
use App\Http\Controllers\Admin\MangaCollectionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserTransactionController;
use App\Http\Middleware\VerifyCsrfTokenAll;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.admin'])->prefix('admin')->group(function() {
    
    Route::get('/', [ AdminController::class, 'dashboard' ])->name('admin.dashboard');

    Route::prefix('manga')->group(function(){

        Route::get('all', [ MangaController::class, 'all' ])->name('admin.manga.all');
        Route::get('add', [ MangaController::class, 'add' ])->name('admin.manga.add');
        Route::post('add', [ MangaController::class, 'save' ])->name('admin.manga.save');
        Route::get('{id}/edit', [ MangaController::class, 'edit' ])->name('admin.manga.edit');
        Route::get('{id}/delete', [ MangaController::class, 'delete' ])->name('admin.manga.delete')->middleware(VerifyCsrfTokenAll::class);

        Route::get('{id}/chapters', [ ChapterController::class, 'all' ])->name('admin.manga.chapter.all');
        Route::post('{id}/chapter/save', [ ChapterController::class, 'save' ])->name('admin.manga.chapter.save');
        Route::get('{id}/chapter/add', [ ChapterController::class, 'add' ])->name('admin.manga.chapter.add');
        Route::get('{id}/chapter/{chapter}/edit', [ ChapterController::class, 'edit' ])->name('admin.manga.chapter.edit');
        Route::get('{id}/chapter/{chapter}/delete', [ ChapterController::class, 'delete' ])->name('admin.manga.chapter.delete')->middleware(VerifyCsrfTokenAll::class);

    });

    Route::prefix('user')->group(function(){
        Route::get('all', [ UserController::class, 'all' ])->name('admin.user.all');
        Route::get('add', [ UserController::class, 'add' ])->name('admin.user.add');
        Route::post('save', [ UserController::class, 'save' ])->name('admin.user.save');
        Route::get('{id}/edit', [ UserController::class, 'edit' ])->name('admin.user.edit');
        Route::post('{id}/update', [ UserController::class, 'update' ])->name('admin.user.update');
        Route::get('{id}/delete', [ UserController::class, 'delete' ])->name('admin.user.delete')->middleware(VerifyCsrfTokenAll::class);
    });

    Route::prefix('comment')->group(function(){
        Route::get('all', [ CommentController::class, 'all' ])->name('admin.comment.all');
        Route::get('{id}/delete', [ CommentController::class, 'delete' ])->name('admin.comment.delete')->middleware(VerifyCsrfTokenAll::class);
    });

    /**
     * Manga Collections routes
     */
    Route::prefix('collection')->group(function() {
        Route::get('{type}/all', [ MangaCollectionController::class, 'all' ])->name('admin.collection.all');
        Route::get('{type}/add', [ MangaCollectionController::class, 'add' ])->name('admin.collection.add');
        Route::post('{type}/save', [ MangaCollectionController::class, 'save' ])->name('admin.collection.save');
        Route::get('{type}/{id}/edit', [ MangaCollectionController::class, 'edit' ])->name('admin.collection.edit');
        Route::get('{type}/{id}/delete', [ MangaCollectionController::class, 'delete' ])->name('admin.collection.delete')->middleware(VerifyCsrfTokenAll::class);
    });

    /**
     * Ajax routes
     */
    Route::prefix('ajax')->group(function(){

        Route::prefix('collection')->group(function(){
            Route::get('{type}/list', [ MangaCollectionController::class, 'ajaxList' ])->name('admin.ajax.collection.list');
            Route::get('{type}/search', [ MangaCollectionController::class, 'ajaxSearch' ])->name('admin.ajax.collection.search');
        });

        Route::prefix('manga')->group(function(){
            Route::get('list', [ MangaController::class, 'ajaxList' ])->name('admin.ajax.manga.list');
            Route::get('{id}/chapters', [ ChapterController::class, 'ajaxList' ])->name('admin.ajax.chapter.list');
        });

        Route::get('user/list', [ UserController::class, 'ajaxList' ])->name('admin.ajax.user.list');
        Route::get('transaction/list', [ UserTransactionController::class, 'ajaxList'])->name('admin.ajax.transaction.list');
        Route::get('comment/list', [ CommentController::class, 'ajaxList'])->name('admin.ajax.comment.list');
    });

    Route::get('settings', function(){
        
    })->name('admin.settings');

    Route::get('transaction/all', [ UserTransactionController::class, 'all'])->name('admin.transaction.all');

});
