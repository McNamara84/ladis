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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained()->restrictOnDelete();
            $table->string('name', 50)->unique();
            // text() creates a TEXT column for longer texts
            $table->text('description')->nullable();
            // year() creates a YEAR column (4-digit year)
            $table->year('year')->nullable();
            // comment() adds a comment to the column in the database
            // Useful for documentation directly in the DB
            $table->unsignedTinyInteger('build')->nullable()->comment('0: Glasfaser, 1: Spiegelarm, 2: …?');
            // integer() creates an INT column
            // unsingned turns it into positive only
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('depth')->nullable();
            // decimal() creates a DECIMAL column
            // First parameter: total number of digits
            // Second parameter: decimal places
            $table->decimal('weight', 5, 2)->unsigned()->nullable();
            $table->decimal('fiber_length', 5, 2)->unsigned()->nullable();
            $table->unsignedTinyInteger('cooling')->nullable()->comment('0: intern, 1: extern');
            // boolean() is an alias for tinyInteger(1)
            // In MySQL this is stored as TINYINT(1)
            $table->boolean('mounting')->nullable();
            $table->boolean('automation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
