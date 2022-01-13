<?php

namespace App\Traits;

use App\Models\Manga;
use Illuminate\Support\Facades\Log;

trait MangaQuery {

    /**
     * Query mangas by sold
     */
    public static function queryBestSelling() {
        $query = Manga::leftJoin(
            'user_purchases', 
            'mangas.id', '=', 'user_purchases.manga_id'
        )
        ->selectRaw('mangas.*, COUNT(user_purchases.user_id) as sold')
        ->groupBy('mangas.id')
        ->orderByDesc('sold');
        return $query;
    }

    /**
     * Query mangas by most views
     */
    public static function queryPopular() {
        return Manga::leftJoin('manga_views', 'mangas.id', '=', 'manga_views.manga_id')
        ->selectRaw('*, SUM(manga_views.views) as total_views')
        ->groupBy('mangas.id')
        ->orderByDesc('total_views');
    }

    public static function queryNewest() {
        return Manga::orderByDesc('created_at');
    }

    public static function queryRandom() {
        return Manga::inRandomOrder();
    }

    public static function queryLatest() {
        return Manga::select('mangas.*')
        ->leftJoin('chapters', 'chapters.manga_id', '=', 'mangas.id')
        ->groupBy('mangas.id')
        ->orderByDesc('chapters.created_at');
    }

    public static function queryTopRated() {
        return Manga::orderByDesc('rating');
    }
}

