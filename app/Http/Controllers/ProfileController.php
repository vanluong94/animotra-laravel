<?php

namespace App\Http\Controllers;

use App\Exceptions\PaypalException;
use App\Helper\PayPalClient;
use App\Helper\Str;
use App\Models\UserCoinLog;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{
    public function profile(Request $request) {
        return view('app.profile', [ 'user' => $request->user() ]);
    }

    public function update(Request $request) {

        $data = $request->validate([
            'user_name'     => 'required',
            'user_email'    => 'required|email',
            'user_password' => 'required',
        ]);

        $user = $request->user();

        if( ! Hash::check( $data['user_password'], $user->password ) ) {
            return redirect()->route('profile')->withErrors([
                'msg' => 'Password is incorrect, failed to update information'
            ]);
        }

        $user->update([
            'name'  => $data['user_name'],
            'email' => $data['user_email']
        ]);

        return redirect()->route('profile')->with([
            'successMsg' => 'Updated successfully!'
        ]);
    }

    public function password(Request $request) {

        $data = $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|confirmed',
        ]);

        $user = $request->user();

        if( ! Hash::check( $data['current_password'], $user->password ) ) {
            return redirect()->route('profile')->withErrors([
                'msg' => 'Password is incorrect, failed to update new password'
            ]);
        } 

        $user->update([
            'password' => Hash::make( $data['new_password'] )
        ]);

        return redirect()->route('profile')->with([
            'successMsg' => 'Password updated successfully!'
        ]);

    }

    public function comments(Request $request) {
        return view('app.profile-comments', [
            'user'     => $request->user(),
            'comments' => $request->user()->comments()->orderBy('created_at', 'desc')->limit(10)->get()
        ]);
    }

    public function notifications(Request $request) {
        return view('app.profile-notifications', [
            'user' => $request->user()
        ]);
    }
    
    public function favorites(Request $request) {
        return view('app.profile-favorite', [
            'user' => $request->user(),
            'mangas' => $request->user()->favoriteMangas()->paginate(9)
        ]);
    }

    public function readLater(Request $request) {
        return view('app.profile-readlater', [
            'user' => $request->user(),
            'mangas' => $request->user()->readLaterMangas()->paginate(9)
        ]);
    }

    public function subscriptions(Request $request) {
        return view('app.profile-subscribe', [
            'user' => $request->user(),
            'mangas' => $request->user()->subscribedMangas()->paginate(9)
        ]);
    }

    public function topupPage(Request $request) {
        return view('app.profile-topup', [
            'user' => $request->user()
        ]);
    }

    public function topup(Request $request) {

        $data = $request->validate([
            'token_amount' => 'required|integer|min:1000',
            'paypal_token' => 'required'
        ]);

        $price = intval( $data['token_amount'] ) * intval( env('TOKEN_RATE') );

        try {

            $order = PayPalClient::getOrder( $data['paypal_token'] )->result;
            $order = json_decode( json_encode( $order ), true );
    
            /**
             * 1. validate status
             */
            if( ! in_array( $order['status'], array( 'COMPLETED' ) ) ){
                throw new PaypalException('Failed to complete transaction');
            }
    
            /**
             * 2. validate amount
             */
            if( empty( $order['purchase_units'] ) ){
                throw new PaypalException('Unable to find valid purchase unit');
            }
    
            $purchase = $order['purchase_units'][0];
            if( $purchase['amount']['currency_code'] != 'USD' || $purchase['amount']['value'] < $price ){
                throw new PaypalException('Purchase is invalid, please contact us for more details');
            }

            $transaction = UserTransaction::whereOrderId( $order['id'] )->first();
            if( $transaction ){
                throw new PaypalException('This order is already completed');
            }

            DB::beginTransaction();

            UserTransaction::create([
                'user_id'  => $request->user()->id,
                'price'    => $price,
                'order_id' => $order['id'],
                'coins'    => $data['token_amount'],
            ]);

            UserCoinLog::create([
                'user_id' => $request->user()->id,
                'type'    => 'topup',
                'coin'    => $data['token_amount'],
                'entry'   => sprintf( 'Topup %d tokens via Paypal payment gateway', $data['token_amount'] )
            ]);

            $request->user()->addBalance( $data['token_amount'] );

            DB::commit();

        } catch (PaypalException $e) {
            return redirect()->route('profile.topup.page')->withErrors([
                'msg' => 'Failed to complete the payment. ' . $e->getMessage()
            ]);
        }
       
        return redirect()->route('profile.topup.page')->with([
            'successMsg' => sprintf( 'Topup %d tokens successfully!', $data['token_amount'] )
        ]);

    }

    public function logs(Request $request) {
        return view('app.profile-logs', [
            'user' => $request->user()
        ]);
    }

    public function ajaxLogs(Request $request) {

        $logs = $request->user()->logs();

        return DataTables::of( $logs )
        ->editColumn('created_at', function( $log ){
            return Str::humanReadString( $log->created_at );
        })
        ->editColumn('type', function( $log ){
            return ucfirst( $log->type );
        })
        ->addColumn('token', function( $log ){
            return $log->coin;
        })
        ->rawColumns(['entry'])
        ->make();

    }
}
