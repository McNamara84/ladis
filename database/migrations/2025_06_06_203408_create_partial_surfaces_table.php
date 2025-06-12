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
        Schema::create('partial_surfaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_surface_id')->constrained('sample_surfaces')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('foundation_material_id')->constrained('materials')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('coating_material_id')->constrained('materials')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('condition_id')->constrained('conditions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreignId('result_id')->constrained('conditions')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->text('identifier')->nullable();
            $table->decimal('size', 5, 2)->unsigned()->comment('in cm²');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partial_surfaces');
    }
};
