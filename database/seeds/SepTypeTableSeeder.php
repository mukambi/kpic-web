<?php

use App\SepType;
use Illuminate\Database\Seeder;

class SepTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SepType::create([
            'name' => 'Facility',
            'code' => 'F'
        ]);
        SepType::create([
            'name' => 'Community',
            'code' => 'C'
        ]);
        SepType::create([
            'name' => 'Prisons',
            'code' => 'P'
        ]);
    }
}
