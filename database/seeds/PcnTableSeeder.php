<?php

use App\Pcn;
use Illuminate\Database\Seeder;

class PcnTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pcn::create([
            'name' => 'FSW',
            'number' => 9
        ]);
        Pcn::create([
            'name' => 'MSM',
            'number' => 8
        ]);
        Pcn::create([
            'name' => 'PWID',
            'number' => 7
        ]);
        Pcn::create([
            'name' => 'TG',
            'number' => 6
        ]);
        Pcn::create([
            'name' => 'All other PPs',
            'number' => 5
        ]);
    }
}
