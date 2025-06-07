<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for the 'materials' table
 * Demo for: self-referencing relationship
 * Table was created with the command: php artisan make:migration create_materials_table
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            // ID is created automatically
            $table->id();

            // string() creates a VARCHAR column with default length 255
            // The first parameter is the column name, the second the length
            $table->string('name', 50)->unique(); // unique() adds a UNIQUE INDEX

            // unsignedBigInteger() creates a BIGINT UNSIGNED column for foreign keys
            // nullable() makes the column optional (NULL allowed)
            // This allows materials without a parent element (top-level hierarchy has no parent)
            $table->unsignedBigInteger('parent_id')->nullable();

            // foreign() defines a foreign-key relationship
            // references() specifies the referenced column
            // on() specifies the referenced table
            // onDelete('restrict') prevents deleting parent elements that still have children
            $table->foreign('parent_id')->references('id')->on('materials')->onDelete('restrict')->onUpdate('restrict');

            // timestamps() are created automatically
            // These are managed automatically by Laravel
            $table->timestamps();

            // Index for better performance when querying by parent_id
            $table->index('parent_id', 'fk_material_material1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
