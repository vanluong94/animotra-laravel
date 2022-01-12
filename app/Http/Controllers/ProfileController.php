<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function comments() {

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
}
