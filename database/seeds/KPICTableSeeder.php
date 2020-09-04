<?php

use App\Http\Traits\GeneratesKPIC;
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
        $month = 'January';
        $year = 2020;

        $this->generatedSeedKPIC($sep, $pcn, $first_name, $last_name, $yob, $month, $year);

        $first_name = 'Ezra';
        $last_name = 'Agatha';
        $yob = 1980;
        $month = 'June';
        $year = 2020;

        $this->generatedSeedKPIC($sep, $pcn, $first_name, $last_name, $yob, $month, $year);
    }

    public function generatedSeedKPIC($sep, $pcn, $first_name, $last_name, $yob, $month, $year)
    {
        $patient = Patient::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'yob' => $yob,
            'pcn_id' => $pcn->id,
            'sep_id' => $sep->id,
            'month' => $month,
            'year' => $year
        ]);

        $kpic_code = $this->generateKPIC(
            $patient, $sep, $pcn, $year, $month, $first_name, $last_name, $yob
        );

        $patient->update([
            'kpic_code' => $kpic_code['full_kpic_code'],
            'hash' => Hash::make($kpic_code['full_kpic_code']),
            'short_kpic_code' => $kpic_code['short_kpic_code']
        ]);
    }
}
