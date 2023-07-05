<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FillChannels extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Channel::createChannel('comptoir', 'Tout ce qui ne va pas ailleurs');

        Channel::createChannel('webg4', "Tout ce qui concerne l'UE WEBG4'");

        Channel::createChannel('dev4', 'À propos de DEV4');
    }
}
