<?php

namespace Database\Seeders;
use App\Models\Device;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
/**
 * This function loads Data from a CSV by combining the header row as keys and the rows after as values. This
 * data is then being used to create Devices. Also, values that are not included in the $data array are being added afterwards.
 *
 * @param string $path_to_csv This is the path to the CSV file
 * @param string $delimiter   This is the delimiter that is being used in the CSV file
 * @param int    $institution_id This is the ID of the institution which manufactured the device
 * @param int    $last_edit_by This is the ID of the user that has edited the dataset last
 *
 * @return void                no value is being returned
 */
    private function useDataFromCsvAndCreateDevice(string $path_to_csv, string $delimiter, int $institution_id, int $last_edit_by){

    $csv_file = fopen(base_path($path_to_csv), 'r');
        $header = null;
        while (($row = fgetcsv($csv_file, $delimiter)) !== false) {
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