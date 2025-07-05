<?php

namespace Database\Seeders;
use App\Models\Device;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DeviceSeeder extends Seeder
{

    /**
     * This function loads data from a CSV by combining the header row as keys and the subsequent rows as values.
     * The data is then used to create Devices. Error handling is implemented to ensure that all attributes
     * without given values are transformed to null. If a ValueError 
     * occurs (e.g., mismatched columns), the current file is skipped.
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
            Log::error("Failed to open CSV file at path: $path_to_csv");
            return;
        }

        $header_row = null;
        try {
            while (($row = fgetcsv($csv_file, null, $delimiter)) !== false) {
                if ($header_row == null) {
                    $header_row = $row;
                } else {
                    try {
                        $data = array_combine($header_row, $row);
                    } catch (\ValueError $e) {
                        Log::error("ValueError in file $path_to_csv: " . $e->getMessage());
                        return;
                    }
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
                    );
                }
            }
        } finally {
            fclose($csv_file);
        }
    }

    /**
     * Run the device seeds.
     * 
     * This function loads all CSV files from the 'devices' directory on the 'local' storage disk,
     * reads each file and creates Device records based on the CSV data.
     *
     * Assumes that the files are stored in /storage/app/private/devices/
     * according to the configuration of the 'local' disk.
     * 
     * @return void                no value is being returned
     */


    public function run(): void
    {
        $files = Storage::disk('local')->files('devices');
        foreach ($files as $file) {
            $path = storage_path('app/private/' . $file);
            if (str_ends_with($path, '.csv')) {
                try {
                    $this->useDataFromCsvAndCreateDevice($path, ';');
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
    }
}
