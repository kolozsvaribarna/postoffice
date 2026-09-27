<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/cities.csv');

        $handle = fopen($path, 'r');
        $header = fgetcsv($handle); // skip header row: id, zip_code, name, county_id

        $rows = [];

        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = [
                'id' => $data[0],
                'zip_code' => $data[1],
                'name' => $data[2],
                'county_id' => $data[3],
                // population intentionally left NULL; not present in the source dump
            ];
        }

        fclose($handle);

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('cities')->insertOrIgnore($chunk);
        }
    }
}
