<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\UserCollectionController;
use Illuminate\Support\Facades\Route;

Route::prefix('ajax')->group(function(){

    Route::prefix('manga')->group(function(){
        Route::post('{id}/rate', [ MangaController::class, 'rate' ])->middleware('auth')->name('ajax.manga.rate');
    });

    Route::post('user_collection/toggle', [ UserCollectionController::class, 'toggle' ])->middleware('auth')->name('ajax.user_collection.toggle');

});
