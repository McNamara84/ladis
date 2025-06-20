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
        Schema::create('conditions', function (Blueprint $table) {
            // There is no need to implement a unique index for the primary key
            // since id() already provides a unique index. The same applies to autoIncrement() which is not needed.
            $table->id();
            $table->foreignId('damage_pattern_id')->constrained('damage_patterns')->cascadeOnDelete();
            $table->float('wac')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->decimal('lab_l', 5, 2)->unsigned()->nullable();
            $table->decimal('lab_a', 5, 2)->nullable();
            $table->decimal('lab_b', 5, 2)->nullable();
            $table->tinyInteger('severity')->unsigned();
            $table->tinyInteger('adhesion')->unsigned();
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conditions');
    }
};
