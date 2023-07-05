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
              return view('chatrooms', ['channels' => $channels]);
          }

          public function getMessages($channel)
          {
              $messages = Message::getMessages($channel);
              return view('channel', ['messages' => $messages]);
          }

          public function putMessage($channel)
          {
                    $content = $_POST["message"];
                    Message::putMessage($channel, Auth::id(), $content);
                    return view('channel', ['messages' => Message::getMessages($channel)]);
          }
}
