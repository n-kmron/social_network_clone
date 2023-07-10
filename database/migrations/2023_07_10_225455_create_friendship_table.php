<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('friendship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("person1");
            $table->unsignedBigInteger("person2");
            $table->enum('status', ['pending', 'confirmed']);
            $table->timestamps();

            $table->foreign("person1", "person1fk")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("person2", "person2fk")->references("id")->on("users")->cascadeOnDelete();
            $table->unique(["person1", "person2"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friendship');
    }
};
