<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\Manga;
use App\Models\UserTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard() {

        $now = Carbon::now();

        $transactions = DB::table('user_transactions')
            ->selectRaw('SUM(price) as earning, COUNT(id) as orders')
            ->whereMonth('created_at', '=', $now)
            ->first();

        $earning = Str::humanReadMoney( $transactions->earning );
        $orders = Str::humanReadNumber( $transactions->orders );

        $mangas = DB::table('mangas')->selectRaw('COUNT(id) as total')->first();
        $mangas = Str::humanReadNumber( $mangas->total );

        $users = DB::table('users')->selectRaw('COUNT(id) as total')->first();
        $users = Str::humanReadNumber( $users->total );

        $revenue = DB::table('user_transactions')->select(
            DB::raw('SUM(price) as `data`'), 
            DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') day")
        )
        ->whereDate( 'created_at', '>=', Carbon::now()->subWeek() )
        ->whereDate( 'created_at', '<=', $now )
        ->orderBy('created_at', 'asc')
        ->groupby('day')->get();

        $revenueChartData = [
            'labels' => $revenue->pluck('day')->toArray(),
            'data' => $revenue->pluck('data')->toArray(),
        ];

        $coins = DB::table('user_coin_logs')->select(
            DB::raw('IF(coin>0, "Available", "Spent") as label'),
            DB::raw('ABS(SUM(coin)) as total')
        )->groupBy('label')->get();
        
        $coinsChartData = [
            'labels' => $coins->pluck('label')->toArray(),
            'data' => $coins->pluck('total')->toArray()
        ];

        $bestSellingMangas = DB::table('mangas')->leftJoin(
            'user_purchases', 
            'mangas.id', '=', 'user_purchases.manga_id'
        )
        ->selectRaw('mangas.*, COUNT(user_purchases.user_id) as sold')
        ->whereMonth('user_purchases.created_at', '=', $now)
        ->groupBy('mangas.id')
        ->orderByDesc('sold')
        ->limit(10)
        ->get();

        $bestSellingData = [
            'labels' => $bestSellingMangas->pluck('title')->toArray(),
            'data'   => $bestSellingMangas->pluck('sold')->toArray()
        ];

        return view('admin.dashboard', compact([
            'earning', 'orders', 'mangas', 'users', 'revenueChartData', 'coinsChartData', 'bestSellingData'
        ]));
    }

    public function settings() {
        return view('admin.settings', [
            'featured_collection' => Manga::queryFeatured()->get(),
            'default_coin'        => config('animotra.default_coin'),
            'token_rate'          => config('animotra.token_rate', 0.001)
        ]);
    }

    public function saveSettings(Request $request) {

        $data = $request->validate([
            'featured_collection' => 'nullable|array',
            'default_coin'        => 'nullable|numeric',
            'token_rate'          => 'required|numeric|gt:0',
        ]);

        if( isset( $data['featured_collection'] ) ){
            $data['featured_collection'] = implode(',', $data['featured_collection']);
        }

        $output = collect( $data )->filter()->toArray();

        $output = "<?php return " . var_export( $output, true ) . "; ?>";

        file_put_contents( base_path('config/animotra.php'), $output );
        
        return view('admin.settings', [
            'featured_collection' => Manga::queryFeatured()->get(),
            'default_coin'        => config('animotra.default_coin'),
            'token_rate'          => config('animotra.token_rate', 0.001)
        ])->with([
            'successMsg' => 'Updated successfully!'
        ]);
    }
}
