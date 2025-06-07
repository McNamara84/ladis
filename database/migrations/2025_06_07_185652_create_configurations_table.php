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
            $table->integer('lens_size')->unsigned();
            $table->integer('focal_length')->unsigned();
            $table->float('output', 2)->unsigned();
            $table->integer('pw')->unsigned();
                //pulse_width (pw)
            $table->integer('pf')->unsigned();
                //pulse_frequency (pf)
            $table->integer('scan_frequency')->unsigned();
            $table->float('scan_frequency', 1)->unsigned();
            $table->float('spot_size', 1)->unsigned();
            $table->float('fluence', 3)->unsigned();
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
        Schema::dropIfExists('configurations');
    }
};
