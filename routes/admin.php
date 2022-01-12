<?php

use App\Http\Controllers\Admin\ChapterAjaxController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\MangaController;
use App\Http\Controllers\Admin\MangaCollectionController;
use App\Http\Middleware\VerifyCsrfTokenAll;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.admin'])->prefix('admin')->group(function() {
    
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('manga')->group(function(){

        Route::get('all', [ MangaController::class, 'all' ])->name('admin.manga.all');
        Route::get('add', [ MangaController::class, 'add' ])->name('admin.manga.add');
        Route::post('save', [ MangaController::class, 'save' ])->name('ajax.manga.save');
        Route::get('{id}/edit', [ MangaController::class, 'edit' ])->name('admin.manga.edit');
        Route::get('{id}/delete', [ MangaController::class, 'delete' ])->name('admin.manga.delete')->middleware(VerifyCsrfTokenAll::class);

        Route::get('{id}/chapters', [ ChapterController::class, 'all' ])->name('admin.manga.chapter.all');
        Route::post('{id}/chapter/save', [ ChapterController::class, 'save' ])->name('admin.manga.chapter.save');
        Route::get('{id}/chapter/add', [ ChapterController::class, 'add' ])->name('admin.manga.chapter.add');
        Route::get('{id}/chapter/{chapter}/edit', [ ChapterController::class, 'edit' ])->name('admin.manga.chapter.edit');
        Route::get('{id}/chapter/{chapter}/delete', [ ChapterController::class, 'delete' ])->name('admin.manga.chapter.delete')->middleware(VerifyCsrfTokenAll::class);

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

    });

    Route::get('settings', function(){
        
    })->name('admin.settings');

});
