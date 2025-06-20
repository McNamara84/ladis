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

    private function useDataFromCsvAndCreateDevice(string $path_to_csv, string $separator, int $institution_id, int $last_edit_by){

    $csv_file = fopen(base_path($path_to_csv), 'r');
        $header = null;
        while (($row = fgetcsv($csv_file, 2000, $separator)) !== false) {
            if ($header == null) {
                $header = $row;
            } else {
                $data = array_combine($header, $row);
                Device::create(
                    array_merge(
                        $data,
                        [
                            'institution_id' => $institution_id,
                            'last_edit_by' => $last_edit_by,
                        ]
                    )
                );
            }
        }
        fclose($csv_file);
    }

       public function run(): void
    { 
        $this->useDataFromCsvAndCreateDevice('database\data\devices\CL20_Backpack.csv',';',2,1);
        $this->useDataFromCsvAndCreateDevice('database\data\devices\THUNDER_COMPACT.csv',';',1,1);
        $this->useDataFromCsvAndCreateDevice('database\data\devices\Infinito Laser_p_n _I054C1.csv',';',1,1);
}
}