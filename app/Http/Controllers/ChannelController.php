<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
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

          public function getMessages($channel)
          {
              $messages = Message::getMessages($channel);
              return view('channel', [
                  'messages' => $messages,
                  'suggestions' => FriendController::getSuggestions()
              ]);
          }

          public function sendMessage($channel)
          {
                    $content = $_POST["message"];
                    Message::sendMessage($channel, Auth::id(), $content);
                    return ChannelController::getMessages($channel);
          }
}
