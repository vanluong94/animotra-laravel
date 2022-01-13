<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function all() {
        return view('admin.user.all');
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
            return Str::humanReadString( $manga->created_at );
        })
        ->editColumn('avatar', function( User $user ){
            return sprintf( '<img src="%s"/>', $user->getAvatar() );
        })
        ->editColumn('role', function( User $user ){
            return sprintf( '<div class="text-center"><span class="badge rounded-pill %s text-white py-2 px-3">%s</span></div>', $user->role == 'admin' ? 'bg-primary' : 'bg-secondary', $user->role );
        })
        ->rawColumns(['actions', 'avatar', 'role'])
        ->make();

    }
}
