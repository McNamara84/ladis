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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            // foreignId() is shorthand for unsignedBigInteger()
            // with automatic naming for foreign-key relationships
            // constrained() automatically creates the foreign-key relationship
            $table->foreignId('federal_state_id')->constrained('federal_states')->restrictOnDelete()->restrictOnUpdate();
            $table->string('name', 45);
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
