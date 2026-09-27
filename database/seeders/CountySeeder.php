<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/counties.csv');

        $handle = fopen($path, 'r');
        $header = fgetcsv($handle); // skip header row: id, name

        $rows = [];

        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = [
                'id' => $data[0],
                'name' => $data[1],
                // coat_of_arms_url intentionally left NULL; not present in the source dump
            ];
        }

        fclose($handle);

        foreach (array_chunk($rows, 500) as $chunk) {
            DB::table('counties')->insertOrIgnore($chunk);
        }
    }
}
