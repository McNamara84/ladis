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
        Schema::create('sample_surface', function (Blueprint $table) {
            $table->id();

			$table->string('name', 50) -> unique() 
            $table->text('description');
            
            $table->timestamps();

            // Foreign key refrences to the table object 
            $table->foreignId('object_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_surface');
    }
};
