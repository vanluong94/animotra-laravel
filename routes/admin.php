<?php

use App\Http\Controllers\Admin\ChapterAjaxController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\MangaController;
use App\Http\Controllers\Admin\MangaCollectionController;
use App\Http\Middleware\VerifyCsrfTokenAll;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.admin'])->prefix('admin')->group(function() {
    
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('manga')->group(function(){

        Route::get('all', [ MangaController::class, 'all' ])->name('admin.manga.all');
        Route::get('add', [ MangaController::class, 'add' ])->name('admin.manga.add');
        Route::get('edit/{id}', [ MangaController::class, 'edit' ])->name('admin.manga.edit');
        Route::post('save', [ MangaController::class, 'save' ])->name('ajax.manga.save');
        Route::get('delete/{id}', [ MangaController::class, 'delete' ])->name('admin.manga.delete')->middleware(VerifyCsrfTokenAll::class);

        Route::get('chapters', function(){
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
            Route::get('{type}/list', [ MangaCollectionController::class, 'ajaxList' ])->name('admin.ajax.collection.list');
            Route::get('{type}/search', [ MangaCollectionController::class, 'ajaxSearch' ])->name('admin.ajax.collection.search');
        });
        
        Route::prefix('chapter')->group(function(){
            Route::post('save', [ ChapterAjaxController::class, 'save' ])->name('ajax.chapter.save');
            Route::post('upload', [ ChapterAjaxController::class, 'upload' ])->name('ajax.chapter.upload')
                ->withoutMiddleware(VerifyCsrfToken::class);
        });

        Route::prefix('manga')->group(function(){
            Route::get('list', [ MangaController::class, 'ajaxList' ])->name('admin.ajax.manga.list');
        });

    });

});
