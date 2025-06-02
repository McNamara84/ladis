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
        Schema::create('federal_states', function (Blueprint $table) {
            $table->id();
            // For federal states of Germany VARCHAR(23) is enough
            // The longest state name is "Mecklenburg-Vorpommern" with 22 characters
            $table->string('name', 23)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('federal_states');
    }
};
