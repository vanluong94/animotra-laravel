<?php

namespace App\Traits;

use App\Models\Manga;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait ChapterQuery {

    public static function findBySlug( $manga_slug, $chapter_slug ) {
        return self::whereHas('manga', function(Builder $query) use ($manga_slug) {
            $query
                ->whereSlug( $manga_slug )
                ->wherePublishStatus('published')
                ->where('published_at', '<=', Carbon::now());
        })->whereSlug( $chapter_slug )->where('released_at', '<=', Carbon::now())->first();
    }

}
