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
        Schema::create('lenses', function (Blueprint $table) {
            $table->id();
            // tinyInteger() creates a TINYINT column (-128 to 127)
            // unsigned turns it into 0 to 255
            $table->unsignedTinyInteger('size')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lenses');
    }
};
