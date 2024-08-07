<?php

namespace Database\Seeders;

use App\Models\UpayaFisik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpayaFisikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/upaya_fisik.json')), true);

        foreach ($data as $unitKerja) {
            UpayaFisik::create($unitKerja);
        }
    }
}
