<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FillPosts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'owner' => 1,
            'name' => 'First article',
            'content' => "Oh right. I forgot about the battle. I just told you! You've be killed me ! You don't know how to do any of those. Hey, you add a one and two zeros to that or we walk! No! Don't jump !
                            I'm sure those windmills will keep them cool. Who am I making this out to? Yes, if you make it look like an electrical fire. When you do things right, people won't be sure you've done anything at all. Who's a real live robot or is that some king of cheesy New Year's costume ?",
            'picture_link' => 'posts/1/background2.png',
            'likes' => 121,
        ]);

        Post::create([
            'owner' => 2,
            'name' => 'Countryside',
            'content' => "Oh right. I forgot about the battle. I just told you! You've be killed me ! You don't know how to do any of those. Hey, you add a one and two zeros to that or we walk! No! Don't jump !
                            I'm sure those windmills will keep them cool. Who am I making this out to? Yes, if you make it look like an electrical fire. When you do things right, people won't be sure you've done anything at all. Who's a real live robot or is that some king of cheesy New Year's costume ?",
            'picture_link' => 'posts/2/background.png',
            'likes' => 3124,
        ]);
    }
}
