<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This is the n-side of the 1:n relationship
     * between federal states and cities.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            // foreignId() is shorthand for unsignedBigInteger()
            // with automatic naming for foreign-key relationships
            // constrained() automatically creates the foreign-key relationship
            $table->foreignId('federal_state_id')->constrained('federal_states')->restrictOnDelete()->restrictOnUpdate();
            $table->string('name', 45);
            // char() creates a fixed-length CHAR column
            // Best for ZIP codes, which are always 5 characters
            $table->char('postal_code', 5)->unique();
            $table->timestamps();
            // unique() on name was omitted because there can be
            // cities with the same name in different federal states
            // (different from the schema of phase 1 and 2)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
