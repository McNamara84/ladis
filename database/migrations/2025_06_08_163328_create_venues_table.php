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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            // Explicitly specify the table name for the foreign key constraint
            // because the default is the plural of the model name and it's
            // irregular for city.
            $table->foreignId('city_id')->constrained('cities')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->string('name', 50);
            // name is unique only within the same city
            $table->unique(['city_id', 'name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
