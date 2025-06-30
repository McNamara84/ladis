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
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('cover_image_id')
                ->references('id')->on('images')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->foreign('thumbnail_image_id')
                ->references('id')->on('images')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['cover_image_id']);
            $table->dropForeign(['thumbnail_image_id']);
        });
    }
};
