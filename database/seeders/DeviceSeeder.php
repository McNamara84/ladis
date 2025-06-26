<?php

namespace Database\Seeders;
use App\Models\Device;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DeviceSeeder extends Seeder
{
    /**
     * Run the device seeds.
     */


    /**
     * This function loads Data from a CSV by combining the header row as keys and the rows after as values. This
     * data is then being used to create Devices.
     *
     * @param string $path_to_csv This is the path to the CSV file
     * @param string $delimiter   This is the delimiter that is being used in the CSV file
     *
     * @return void                no value is being returned
     */
    private function useDataFromCsvAndCreateDevice(string $path_to_csv, string $delimiter)
    {

        $csv_file = fopen($path_to_csv, 'r');

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
                    $data
                )
                ;
            }
        }
        fclose($csv_file);
    }

    public function run(): void
    {
        $files = Storage::disk('local')->files('devices');
        foreach ($files as $file) {
            $path = storage_path('app/private/' . $file);
            $this->useDataFromCsvAndCreateDevice($path, ';');
        }
    }
}
