<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function setPushNotificationToken(Request $request)
    {
        if ($username = $request->input('username')) {
            if ($user = User::where('username', $username)->first()) {
                $token = $request->input('token');
                $user->push_notification_token = $token;
                $user->save();
            }
        }

        return response()->json([], 200);
    }
}
