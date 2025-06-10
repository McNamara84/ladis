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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('project_id')->constrained('projects')->restrictOnDelete();
            $table->string('uri', 255);
            $table->string('description', 255);
            $table->string('alt_text', 255);
            $table->integer('timestamp')->unsigned();
            $table->string('creator', 50);
            // $table->foreignId('condition_id')->constrained('conditions')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
