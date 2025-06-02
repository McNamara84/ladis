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
            // ID wird automatisch erstellt
            $table->id();
            // string() erstellt eine VARCHAR-Spalte mit Standardlänge 255
            // Der erste Parameter ist der Spaltenname, der zweite die Länge
            $table->string('name', 50)->unique(); // unique() fügt einen UNIQUE INDEX hinzu
            // unsignedBigInteger() erstellt eine BIGINT UNSIGNED Spalte für Fremdschlüssel
            // nullable() macht die Spalte optional (NULL erlaubt)
            // Dies ermöglicht Materialien ohne Elternelement (oberste Hierarchieebene hat ja kein Elternelement)
            $table->unsignedBigInteger('parent_id')->nullable();
            // foreign() definiert eine Fremdschlüsselbeziehung
            // references() gibt die referenzierte Spalte an
            // on() gibt die referenzierte Tabelle an
            // onDelete('restrict') verhindert das Löschen von Elternelementen mit Kindern
            $table->foreign('parent_id')->references('id')->on('materials')->onDelete('restrict')->onUpdate('restrict');
            // timestamps() werden automatisch erstellt
            // Diese werden von Laravel automatisch verwaltet
            $table->timestamps();
            // Index für bessere Performance bei Abfragen nach parent_id
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
