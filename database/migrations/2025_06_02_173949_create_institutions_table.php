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
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            // enum() creates an ENUM column with predefined values
            // Advantage: the database enforces valid values
            // Disadvantage: changes require migrations
            // TODO: Consider translating these values? Or using a separate table for types?
            $table->enum('type', ['Auftraggeber', 'Auftragnehmer', 'Hersteller']);
            $table->string('contact_information', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('institutions');
    }
};
