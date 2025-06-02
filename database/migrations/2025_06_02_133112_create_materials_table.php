<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration für die Tabelle 'materials'
 * Demo für: Selbstreferenzierende Beziehung
 * Tabelle wurde erstellt mit dem Befehl: php artisan make:migration create_materials_table
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            // string() erstellt eine VARCHAR-Spalte mit Standardlänge 255
            // Der erste Parameter ist der Spaltenname, der zweite die Länge
            $table->string('name', 50)->unique(); // unique() fügt einen UNIQUE INDEX hinzu
            $table->timestamps();
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
