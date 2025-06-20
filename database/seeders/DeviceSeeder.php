<?php

namespace Database\Seeders;
use App\Models\Device;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the device seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('database\data\devices\CL20_Backpack.csv'), 'r');
        $header = null;
        while (($row = fgetcsv($csv_file, 2000, ";")) !== false) {
            if ($header == null) {
                $header = $row;
            } else {
                $data = array_combine($header, $row);
                Device::create(
                    array_merge(
                        $data,
                        [
                            'institution_id' => 2,
                            'last_edit_by' => 1,
                        ]
                    )
                );
            }
        }
        fclose($csv_file);
    }
}
