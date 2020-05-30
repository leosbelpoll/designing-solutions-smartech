<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PushNotificationsController extends Controller
{
    public function pushNotifications(Content $content)
    {
        $content->row(function (Row $row) {
            $page = view('admin.pages.pushNotifications', [])->render();
            $row->column(12, $page);
        });

        return $content;
    }

    public function sendPushNotifications(Request $request)
    {
        $tokens = User::where('push_notification_token', '!=', null)->select('push_notification_token')->groupBy('push_notification_token')->pluck('push_notification_token');
        
        Http::post('https://exp.host/--/api/v2/push/send', [
            'to' => $tokens,
            'sound' => 'default',
            'title' => $request->input('title'),
            'body' =>  $request->input('message'),
            '_displayInForeground' => false,
        ]);

        return redirect()->route('admin.home', ['notification' => ['type' => 'success', 'message' => 'Notificación enviada satisfactoriamente!']]);
    }
}
