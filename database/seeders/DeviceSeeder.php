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


    /**
     * This function loads Data from a CSV by combining the header row as keys and the rows after as values. This
     * data is then being used to create Devices. Also, values that are not included in the $data array are being added afterwards (such as 
     * foreign keys)
     *
     * @param string $path_to_csv This is the path to the CSV file
     * @param string $delimiter   This is the delimiter that is being used in the CSV file
     * @param int    $institution_id This is the ID of the institution which manufactured the device
     * @param int    $last_edit_by This is the ID of the user that has edited the dataset last
     *
     * @return void                no value is being returned
     */
    private function useDataFromCsvAndCreateDevice(string $path_to_csv, string $delimiter, int $institution_id, int $last_edit_by)
    {

        $csv_file = fopen(base_path($path_to_csv), 'r');

        if ($csv_file === false) {
            throw new \RuntimeException("Failed to open CSV file at path: $path_to_csv");
        }


        $header_row = null;
        while (($row = fgetcsv($csv_file, null, $delimiter)) !== false) {
            if ($header_row == null) {
                $header_row = $row;
            } else {
                $data = array_combine($header_row, $row);
                $data = array_map(
                    function ($value) {
                        if ($value === '')
                            $value = null;
                        return $value;
                    },
                    $data
                );
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
        $this->useDataFromCsvAndCreateDevice(implode(DIRECTORY_SEPARATOR, ['database', 'data', 'devices', 'CL20_Backpack.csv']), ';', 2, 1);
        $this->useDataFromCsvAndCreateDevice(implode(DIRECTORY_SEPARATOR, ['database', 'data', 'devices', 'THUNDER_COMPACT.csv']), ';', 1, 1);
        $this->useDataFromCsvAndCreateDevice(implode(DIRECTORY_SEPARATOR, ['database', 'data', 'devices', 'Infinito Laser_p_n _I054C1.csv']), ';', 1, 1);
    }
}