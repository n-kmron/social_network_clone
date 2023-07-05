<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FillMessages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Message::createMessage('Bienvenue à tou·te·s', 1, 1);
        Message::createMessage("Quelqu'un aurait vu Robin ?", 1, 2);
        Message::createMessage("Batman: non mais j'ai vu la Batmobile tantôt, c'était pas toi ?", 2, 2);
        Message::createMessage("L'examen est disponible", 1, 3);

    }
}
