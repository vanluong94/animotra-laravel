<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function all() {
        return view('admin.user.all');
    }

    public function add() {
        return view('admin.user.add');
    }

    public function save(Request $request) {

        $request->validate([
            'avatar_file' => ['file', 'image'],
            'username'    => ['required', 'string', 'max:255', 'unique:users'],
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'    => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->maybeUploadAvatar();

        return redirect()->route('admin.user.edit', $user->id)->with([
            'successMsg' => 'Added new user successfully!'
        ]);

    }
    
    public function update(Request $request, $id) {
        
        $user = User::find( $id );

        if( ! $user instanceof User ){
            return redirect()->route('admin.user.all')->withErrors([
                'msg' => 'User not found'
            ]);
        }

        $rules = [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];

        if( $request->input('email') != $user->email ){
            $rules['email'][] = 'unique:users';
        }

        if( $request->input('password') ){
            $rules['password'] = ['confirmed', Rules\Password::defaults()];
        }

        if( $request->input('avatar_file') ) {
            $rules['avatar_file'] = ['file', 'image'];
        }

        $data = $request->validate( $rules );
        
        $user->update( $data );
        $user->maybeUploadAvatar();

        return redirect()->route('admin.user.edit', $user->id)->with([
            'successMsg' => 'Update user successfully!'
        ]);
    }

    public function edit( $id ) {
        $user = User::find( $id );

        if( ! $user instanceof User ){
            return redirect()->route('admin.user.all')->withErrors([
                'msg' => 'User not found'
            ]);
        }

        return view('admin.user.edit', compact(['user']));
    }

    public function delete( $id ) {

        $user = User::find( $id );

        if( ! $user instanceof User ){
            return redirect()->route('admin.user.all')->withErrors([
                'msg' => 'User not found'
            ]);
        }

        $user->chapters()->detach();
        $user->mangas()->detach();
        $user->notifications()->detach();
        $user->delete();

        return redirect( 
            route('admin.user.all' ) 
        )->with( 'successMsg', sprintf( 
            'Deleted user "%s" successfully!', 
            $user->email 
        ) );

    }

    public function ajaxList() {

        $users = User::query();

        return DataTables::of( $users )
        ->addColumn('actions', function( User $user ) {

            $output = '';

            $output .= sprintf(
                '<a 
                    class="btn btn-danger btn-sm btn-icon-split"
                    onclick="appUtils.deleteModal( \'User\', \'%s\', \'%s\' )"
                >
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text text-center flex-grow-1">Delete</span>
                </a>',
                $user->name, 
                $user->getAdminDeleteUrl()
            );

            return $output;
        })
        ->editColumn('created_at', function( $manga ){
            return Str::humanReadDatetime( $manga->created_at );
        })
        ->editColumn('avatar', function( User $user ){
            return sprintf( '<img src="%s" class="rounded-circle img-avatar"/>', $user->getAvatar() );
        })
        ->editColumn('role', function( User $user ){
            return sprintf( '<div class="text-center"><span class="badge rounded-pill %s text-white py-2 px-3">%s</span></div>', $user->role == 'admin' ? 'bg-primary' : 'bg-secondary', $user->role );
        })
        ->rawColumns(['actions', 'avatar', 'role'])
        ->make();

    }
}
