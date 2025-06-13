<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50)->unique();
            $table->text('description');
            $table->string(column: 'url', length: 255)->unique();

            // Specific format for the start and end date? 
            // Default format for the datatype date is "YYYY-MM-DD" 
            $table->date(column: 'started_at');
            $table->date(column: 'ended_at');


            $table->timestamps();

            // Foreign key references to the table person 
            $table->foreignId('person_id')->constrained('persons');

            // Foreign key references to the table venue
            $table->foreignId('venue_id')->constrained('venues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};




