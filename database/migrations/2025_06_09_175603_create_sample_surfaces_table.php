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
        Schema::create('sample_surfaces', function (Blueprint $table) {
            $table->id();

            $table->string('name', 50)->unique();
            $table->text('description');

            $table->timestamps();

            // Foreign key references to the table object 
            $table->foreignId('artifacts_id')->constrained('artifacts')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_surfaces');
    }
};
