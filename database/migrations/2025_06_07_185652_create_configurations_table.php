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
            $table->foreignId('lens_id')->constrained('lenses');
            $table->float('focal_length')->unsigned()->comment('in mm');
            $table->float('output')->unsigned()->comment('in J/s (W)');
            $table->float('pw')->unsigned()->comment('pulse width, in ns');
                //pulse_width (pw)
            $table->float('pf')->unsigned()->comment('pulse frequency, in kHz');
                //pulse_frequency (pf)
            $table->float('scan_frequency')->unsigned()->comment('in Hz');
            $table->float('scan_width')->unsigned()->comment('in mm');
            $table->float('spot_size')->unsigned()->comment('in mm²');
            $table->float('fluence')->unsigned()->comment('in J/cm²');
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
