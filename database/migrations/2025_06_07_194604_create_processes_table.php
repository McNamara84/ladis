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
            $table->foreignId('partial_surface_id')->constrained('partial_surfaces')
                ->unique()
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('device_id')->constrained('devices')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('configuration_id')->constrained('configurations')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->enum('duration', [0, 1, 2, 3])
                ->comment('0: 0-3 min; 1: 3-5 min; 2: 5-10 min; 3: 10+ min');
            $table->enum('wet', [0, 1])->comment('0: dry; 1: wet');
            $table->text('description')->nullable();
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
