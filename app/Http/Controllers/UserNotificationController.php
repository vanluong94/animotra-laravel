<?php

namespace App\Http\Controllers;

use App\Models\UserNotifications;
use Illuminate\Http\Request;

class UserNotificationController extends Controller
{
    public function read($id) {
        $noti = UserNotifications::find($id);

        if( ! $noti ){
            abort(404);
        }

        $noti->update([
            'read' => 1
        ]);

        return redirect( $noti->getTargetUrl() );
    }
}
