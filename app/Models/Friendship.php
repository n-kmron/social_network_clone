<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFriendship
 */
class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'person1',
        'person2',
        'status'
    ];
}
