<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for the pivot table between devices and lenses
 * Implements an n:m relationship between devices and lenses
 *
 * Naming convention for pivot tables in Laravel:
 * - Singular
 * - Alphabetical order
 * - Underscore-separated
 * Example: device_lens (Laravel convention) instead of device_has_lens
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_lens', function (Blueprint $table) {
            // Foreign key as part of the composite primary key
            $table->foreignId('device_id')->constrained()->cascadeOnDelete(); // If a device is deleted, its links are deleted as well
            $table->foreignId('lens_id')->constrained('lenses')->cascadeOnDelete(); // Explicit table name because the plural lenses will not be detected automatically
            // primary() defines a composite primary key
            // Prevents duplicate links
            $table->primary(['device_id', 'lens_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_lens');
    }
};
