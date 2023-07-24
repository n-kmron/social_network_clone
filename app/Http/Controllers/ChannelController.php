<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;
use App\Notifications\ChatroomNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ChannelController extends Controller
{
          public function getChannels(): View
          {
              $channels = Channel::all();
              return view('chatrooms', [
                  'channels' => $channels,
                  'suggestions' => FriendController::getSuggestions(),
              ]);
          }

          public function getMessages($channelId) : View
          {
              $messages = Message::getMessages($channelId);
              return view('channel', [
                  'messages' => $messages,
                  'suggestions' => FriendController::getSuggestions()
              ]);
          }

          public function sendMessage($channelId, Request $request) : View
          {
                $content = $request->post('message');
                Message::sendMessage($channelId, Auth::id(), $content);
                $users = User::all();
                foreach($users as $user) {
                    if($user != Auth::user()) {
                        $user->notify(new ChatroomNotification($channelId, $request->post()));
                    }
                }
                return ChannelController::getMessages($channelId);
          }

          public static function getName(int $channelId) : string{
              return Channel::getName($channelId);
          }
}
