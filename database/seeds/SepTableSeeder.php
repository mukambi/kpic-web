<?php

use App\Sep;
use App\SepType;
use Illuminate\Database\Seeder;

class SepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sep::create([
            'name' => 'Lira Regional Referral Hospital',
            'code' => 16,
            'location' => 'Lira, Uganda',
            'type_id' => SepType::where('code', 'F')->first()->id
        ]);
    }
}
