<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperPost
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'name',
        'content',
        'picture_link',
        'likes',
    ];

    public function imageUrl(): string {
        return Storage::disk('public')->url($this->picture_link);
    }
}
