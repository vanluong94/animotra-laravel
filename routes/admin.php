<?php

use App\Http\Controllers\Admin\ChapterAjaxController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\MangaAjaxController;
use App\Http\Controllers\Admin\MangaCollectionController;
use App\Http\Middleware\VerifyCsrfTokenAll;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.admin'])->prefix('admin')->group(function() {
    
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('manga')->group(function(){

        Route::get('/add', function(){
            return view('admin.manga.add');
        })->name('admin.manga.add');

        Route::get('/chapters', function(){
            return view('admin.manga.chapters');
        })->name('admin.manga.chapters');

        // Route::post('/add', )
        

    });
    
    /**
     * Manga Collections routes
     */
    Route::prefix('collection')->group(function() {
        Route::get('{type}/all', [ MangaCollectionController::class, 'all' ])->name('admin.collection.all');
        Route::get('{type}/add', [ MangaCollectionController::class, 'add' ])->name('admin.collection.add');
        Route::post('{type}/save', [ MangaCollectionController::class, 'save' ])->name('admin.collection.save');
        Route::get('{type}/edit/{id}', [ MangaCollectionController::class, 'edit' ])->name('admin.collection.edit');
        Route::get('{type}/delete/{id}', [ MangaCollectionController::class, 'delete' ])->name('admin.collection.delete')->middleware(VerifyCsrfTokenAll::class);
    });

    /**
     * Ajax routes
     */
    Route::prefix('ajax')->group(function(){

        Route::prefix('collection')->group(function(){
            Route::get('{type}/list', [ MangaCollectionController::class, 'ajaxlist' ])->name('admin.ajax.collection.list');
            Route::get('{type}/search', [ MangaCollectionController::class, 'ajaxSearch' ])->name('admin.ajax.collection.search');
        });
        
        Route::prefix('chapter')->group(function(){
            Route::post('save', [ ChapterAjaxController::class, 'save' ])->name('ajax.chapter.save');
            Route::post('upload', [ ChapterAjaxController::class, 'upload' ])->name('ajax.chapter.upload')
                ->withoutMiddleware(VerifyCsrfToken::class);
        });

        Route::prefix('manga')->group(function(){
            Route::post('save', [ MangaAjaxController::class, 'save' ])->name('ajax.manga.save');
        });

    });

});
