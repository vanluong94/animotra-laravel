<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\UserRating;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function all(Request $request) {

        $query = Manga::queryPublished();

        $s          = $request->input('s', '');
        $categories = $request->input('categories', []);
        $tags       = $request->input('tags', []);
        $authors    = $request->input('authors', []);
        $year       = $request->input('year', '');
        $order      = $request->input('order', 'newest');
        $group      = $request->input('group', 'all');

        if( $s ){
            $query = $query->where('title', 'like', "%{$request->s}%")
            ->orWhere('summary', 'like', "%{$request->s}%");
        }

        if( $categories ){
            $query = $query->whereHas('categories', function(Builder $query) use ($categories){
                $query->whereIn('name', $categories);
            });
        }

        if( $tags ){
            $query = $query->whereHas('tags', function(Builder $query) use ($tags){
                $query->whereIn('name', $tags);
            });
        }

        if( $authors ){
            $query = $query->whereHas('authors', function(Builder $query) use ($authors){
                $query->whereIn('name', $authors);
            });
        }

        if( $year ){
            $query = $query->whereHas('year', function(Builder $query) use ($year){
                $query->where('name', $year);
            });
        }

        switch( $order ) {
            case 'alphabet':
                $query->orderBy('title', 'asc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default: 
                $query->orderBy('created_at', 'desc');
                break;
        }

        if( $group == 'all' ){
            // do nothing
        } else if ($group == 'char') {
            $query->whereRaw('title NOT REGEXP \'^[[:alpha:]]\'');
        } else {
            $query->where('title', 'like', $group . '%');
        }

        $mangas = $query->paginate(config('other.paginate'));

        $isSearchExpanded = $request->has('s');

        return view('app.all', compact([
            'mangas', 
            's', 
            'categories', 'tags', 'authors', 'year', 
            'isSearchExpanded', 
            'order', 'group'
        ]));
    }

    public function view( $slug ) {
        $manga = Manga::queryPublished()->whereSlug( $slug )->first();

        if( ! $manga ) {
            abort(404);
        }

        // increase view
        $manga->increaseViews();

        return view('app.manga', compact(['manga']));
    }

    public function rate( Request $request, $id ) {

        $request->validate([
            'rate' => 'required|numeric|max:5|min:0.5'
        ]);

        $manga = Manga::queryPublished()->find( $id );

        if( ! $manga ) {
            abort(404);
        }

        UserRating::updateOrCreate(
            [
                'rate'     => floatval( $request->rate ),
                'manga_id' => $manga->id,
                'user_id'  => $request->user()->id
            ],
            [
                'manga_id' => $manga->id,
                'user_id'  => $request->user()->id
            ]
        );

        $manga->rating = UserRating::whereMangaId( $manga->id )->get()->avg('rate');
        $manga->save();

        return response()->json([
            'success' => true
        ]);

    }

    public function bestSelling() {
        return view('app.page-archive', [
            'title' => 'Best Selling',
            'mangas' => Manga::queryBestSelling()->paginate(config('other.paginate'))
        ]);
    }

    public function newest() {
        return view('app.page-archive', [
            'title' => 'Newest',
            'mangas' => Manga::queryNewest()->paginate(config('other.paginate'))
        ]);
    }

    public function latest() {
        return view('app.page-archive', [
            'title' => 'Latest Mangas',
            'mangas' => Manga::queryLatest()->paginate(config('other.paginate'))
        ]);
    }

    public function topRated() {
        return view('app.page-archive', [
            'title' => 'Top Rated Mangas',
            'mangas' => Manga::queryTopRated()->paginate(config('other.paginate'))
        ]);
    }
}
