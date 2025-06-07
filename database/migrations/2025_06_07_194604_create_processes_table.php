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
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            //added columns
            $table->foreignId('partial_surface_id')->constrained('partial_surface')
                ->unique();
            $table->foreignId('device_id')->constrained('device');
            $table->foreignId('configuration_id')->constrained('configuration');
            $table->enum('duration', [0, 1, 2, 3]);
            $table->enum('wet', [0, 1]);
            $table->text('description')->nullable();
            //timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processes');
    }
};
