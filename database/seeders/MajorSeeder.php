<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $majors = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Manajemen',
            'Akuntansi',
            'Desain Grafis',
            'Teknik Elektro',
            'Teknik Mesin',
            'Hukum',
            'Psikologi',
            'Biologi',
        ];

        foreach ($majors as $m) {
            Major::firstOrCreate(['name' => $m]);
        }
    }
}
