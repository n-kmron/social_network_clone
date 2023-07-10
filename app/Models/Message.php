<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @mixin IdeHelperMessage
 */
class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'author_id',
        'channel_id'
    ];

    public static function createMessage($content, $author, $channel)
    {
        return self::create([
            'content' => $content,
            'author_id' => $author,
            'channel_id' => $channel,
        ]);
    }

    public static function getMessages($channel) {
            $messages = DB::select("SELECT content, u.name AS username, c.name, c.topic, m.updated_at, c.id FROM messages m JOIN channels c ON m.channel_id = c.id JOIN users u ON m.author_id = u.id WHERE channel_id=$channel ORDER BY m.updated_at ASC;");
            return $messages;
    }

    public static function sendMessage($channel, $author, $content)
    {
        $message = new Message();
        $message->content = $content;
        $message->author_id = $author;
        $message->channel_id = $channel;
        $message->save();
    }
}
