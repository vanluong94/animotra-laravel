<?php

namespace App\Traits;

use App\Models\Manga;

trait MangaQuery {

    /**
     * Query mangas by sold
     */
    public static function queryBestSelling() {
        return Manga::leftJoin(
            'user_purchases', 
            'mangas.id', '=', 'user_purchases.manga_id'
        )
        ->selectRaw('*, COUNT(*) as sold')
        ->groupBy('user_purchases.manga_id')
        ->orderByDesc('sold');
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
        return Manga::orderByDesc('updated_at');
    }

    public static function queryTopRated() {
        return Manga::orderByDesc('rating');
    }
}

