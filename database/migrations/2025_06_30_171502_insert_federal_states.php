<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\FederalState;
use Database\Factories\FederalStateFactory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        FederalState::factory()
            ->germanStates()
            ->count(count(FederalStateFactory::$federalStates))
            ->create();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        FederalState::whereIn('name', FederalStateFactory::$federalStates)->delete();
    }
};
