<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperChannel
 */
class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'topic'
    ];

    public static function getName(int $id) : string {
        $channel = Channel::where('id', $id)->first();
        if ($channel) {
            return $channel->name;
        }
        return '[Channel not found]';
    }
}
