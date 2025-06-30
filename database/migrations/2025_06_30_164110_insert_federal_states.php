<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('federal_states')->insert([
            ['name' => 'Baden-Württemberg',],
            ['name' => 'Bayern'],
            ['name' => 'Berlin'],
            ['name' => 'Brandenburg'],
            ['name' => 'Bremen'],
            ['name' => 'Hamburg'],
            ['name' => 'Hessen'],
            ['name' => 'Mecklenburg-Vorpommern'],
            ['name' => 'Niedersachsen'],
            ['name' => 'Nordrhein-Westfalen'],
            ['name' => 'Rheinland-Pfalz'],
            ['name' => 'Saarland'],
            ['name' => 'Sachsen'],
            ['name' => 'Sachsen-Anhalt'],
            ['name' => 'Schleswig-Holstein'],
            ['name' => 'Thüringen'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('federal_states')
            ->whereIn('name', [
                'Baden-Württemberg',
                'Bayern',
                'Berlin',
                'Brandenburg',
                'Bremen',
                'Hamburg',
                'Hessen',
                'Mecklenburg-Vorpommern',
                'Niedersachsen',
                'Nordrhein-Westfalen',
                'Rheinland-Pfalz',
                'Saarland',
                'Sachsen',
                'Sachsen-Anhalt',
                'Schleswig-Holstein',
                'Thüringen',
            ])->delete();
    }
};
