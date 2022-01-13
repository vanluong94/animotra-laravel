<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserTransactionController extends Controller
{
    public function all() {
        return view('admin.transactions');
    }

    public function ajaxList() {

        $transactions = UserTransaction::query();

        return DataTables::of( $transactions )
        ->addColumn('user_id', function( UserTransaction $trans ){
            return $trans->user->id;
        })
        ->addColumn('user_name', function( UserTransaction $trans ){
            return $trans->user->username;
        })
        ->addColumn('user_email', function( UserTransaction $trans ){
            return $trans->user->email;
        })
        ->addColumn('amount', function( UserTransaction $trans ){
            return $trans->coins;
        })
        ->editColumn('price', function( UserTransaction $trans ){
            return '$ ' . $trans->price;
        })
        ->editColumn('created_at', function( UserTransaction $trans ){
            return Str::humanReadDatetime( $trans->created_at );
        })
        ->rawColumns([])
        ->make();
    }
}
