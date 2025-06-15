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
        Schema::create(table: 'images', callback: function (Blueprint $table): void {
            $table->id();
            // $table->foreignId('condition_id')->constrained('conditions')->restrictOnDelete()->nullable();
            // $table->foreignId('project_id')->constrained('projects')->restrictOnDelete();
            $table->string(column: 'uri', length: 255) ->unique();
            $table->string(column: 'description', length: 255) ->nullable();
            $table->string(column: 'alt_text', length: 255);
            $table->year(column: 'year_created');
            $table->string(column: 'creator', length: 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'images');
    }
};
