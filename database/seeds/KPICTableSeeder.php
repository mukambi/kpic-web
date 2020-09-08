<?php

use App\Http\Traits\GeneratesKPIC;
use App\Icon;
use App\Patient;
use App\Pcn;
use App\Sep;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KPICTableSeeder extends Seeder
{
    use GeneratesKPIC;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sep = Sep::first();
        $pcn = Pcn::where('number', 9)->first();

        $first_name = 'Elizabeth';
        $last_name = 'Ageno';
        $yob = 1980;
        $mob = 'April';

        $this->generatedSeedKPIC($sep, $first_name, $last_name, $yob, $mob);

        $first_name = 'Ezra';
        $last_name = 'Agatha';
        $yob = 1980;
        $mob = 'April';

        $this->generatedSeedKPIC($sep, $first_name, $last_name, $yob, $mob);
    }

    public function generatedSeedKPIC($sep, $first_name, $last_name, $yob, $mob)
    {
        $patient = Patient::create([
            'sep_id' => $sep->id,
            'icon_id' => Icon::orderBy('name')->limit(4)->first()->id
        ]);

        $kpic_code = $this->generateKPIC(
            $patient, $sep, $first_name, $last_name, $yob, $mob
        );

        $patient->update([
            'kpic_code' => $kpic_code['full_kpic_code'],
            'hash' => Hash::make($kpic_code['full_kpic_code']),
            'short_kpic_code' => $kpic_code['short_kpic_code']
        ]);
    }
}
