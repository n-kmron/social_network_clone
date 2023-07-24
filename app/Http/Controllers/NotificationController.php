<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\View\View;

class NotificationController extends Controller
{

    public static function getNotifications(User $user) : DatabaseNotificationCollection {
        return $user->unreadNotifications;
    }

    public static function getContent(DatabaseNotification $notification) : string {
        $dataArray = json_decode($notification, true);
        if($dataArray['type'] == 'App\Notifications\FriendshipNotification') {
            if($dataArray['data']['type'] == 'request') {
                $user = User::where('id', $dataArray['data']['friend_id'])->first();
                return $user->name . ' asked you as a friend !';

            } else if($dataArray['data']['type'] == 'confirmed') {
                $user = User::where('id', $dataArray['data']['friend_id'])->first();
                return 'You are now friend with ' . $user->name . ' !';
            }
            return 'unknown friend notification';
        } else if($dataArray['type'] == 'App\Notifications\ChatroomNotification') {
            $channelId = $dataArray['data']['channel_id'];
            return 'There is new message(s) in ' . \App\Http\Controllers\ChannelController::getName($channelId);
        }
        return 'undefined!';
    }
    public function readAll(User $user) : View{
        $user->unreadNotifications->markAsRead();
        return AuthController::index();
    }
}
