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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lens_id')->constrained('lenses')
            $table->smallInteger('focal_length')->unsigned()
                ->digitsBetween(1, 3)
                ->comment('in mm');
            $table->float('output')->unsigned()->comment('in J/s (W)');
            $table->smallInteger('pw')->unsigned()
                //pulse_width (pw)    
                ->digitsBetween(1, 4)
                ->comment('pulse width, in ns');
            $table->smallInteger('pf')->unsigned()
                //pulse_frequency (pf)    
                ->digitsBetween(1, 3)
                ->comment('pulse frequency, in kHz');
            $table->tinyInteger('scan_frequency')->unsigned()
                ->digitsBetween(1, 2)
                ->comment('in Hz');
            $table->decimal('scan_width', 3, 1)->unsigned()->comment('in mm');
            $table->decimal('spot_size', 4, 1)->unsigned()->comment('in mm²');
            $table->decimal('fluence', 5, 3)->unsigned()->comment('in J/cm²');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
