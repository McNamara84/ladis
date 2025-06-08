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
            //added columns
            $table->foreignId('lens_id')->constrained('lens');
            $table->unsignedInteger('focal_length')->comment('in mm');
            $table->float('output', 2)->unsigned()->comment('in J/s (W)');
            $table->unsignedInteger('pw')->comment('pulse width, in ns');
                //pulse_width (pw)
            $table->unsignedInteger('pf')->comment('pulse frequency, in kHz');
                //pulse_frequency (pf)
            $table->unsignedInteger('scan_frequency')->comment('in Hz');
            $table->float('scan_width', 1)->unsigned()->comment('in mm');
            $table->float('spot_size', 1)->unsigned()->comment('in mm²');
            $table->float('fluence', 3)->unsigned()->comment('in J/cm²');
            $table->string('description')->nullable();
            //timestamps
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
