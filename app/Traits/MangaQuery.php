<?php

namespace App\Traits;

use App\Models\Manga;
use Carbon\Carbon;

trait MangaQuery {

    /**
     * Query mangas by sold
     */
    public static function queryBestSelling() {
        $query = Manga::queryPublished()
        ->leftJoin(
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
        return Manga::queryPublished()
        ->leftJoin('manga_views', 'mangas.id', '=', 'manga_views.manga_id')
        ->selectRaw('*, SUM(manga_views.views) as total_views')
        ->groupBy('mangas.id')
        ->orderByDesc('total_views');
    }

    public static function queryNewest() {
        return Manga::queryPublished()->orderByDesc('created_at');
    }

    public static function queryRandom() {
        return Manga::queryPublished()->inRandomOrder();
    }

    public static function queryLatest() {
        return Manga::queryPublished()->select('mangas.*')
        ->leftJoin('chapters', 'chapters.manga_id', '=', 'mangas.id')
        ->groupBy('mangas.id')
        ->orderByDesc('chapters.created_at');
    }

    public static function queryTopRated() {
        return Manga::queryPublished()->orderByDesc('rating');
    }

    public static function queryPublished() {
        return Manga::wherePublishStatus('published')->where('published_at', '<=', Carbon::now());
    }

    public static function queryFeatured() {
        return Manga::whereIn('id', array_filter(
            explode(',', config( 'animotra.featured_collection', '' ) )
        ));
    }
}

