<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'topic'
    ];

    public static function createChannel($name, $topic)
    {
        return self::create([
            'name' => $name,
            'topic' => $topic,
        ]);
    }
}
