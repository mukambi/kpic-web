<?php

use App\Http\Traits\GeneratesKPIC;
use App\Icon;
use App\Patient;
use App\Sep;
use Illuminate\Database\Seeder;

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

        $surname = 'Ageno';
        $first_name = 'Elizabeth';
        $second_name = null;
        $yob = 1980;
        $mob = 'April';

        $this->generatedSeedKPIC($sep, $surname, $first_name, $second_name, $yob, $mob);

        $surname = 'Agatha';
        $first_name = 'Ezra';
        $second_name = null;
        $yob = 1980;
        $mob = 'April';

        $this->generatedSeedKPIC($sep, $surname, $first_name, $second_name, $yob, $mob);
    }

    public function generatedSeedKPIC($sep, $surname, $first_name, $second_name, $yob, $mob)
    {
        $icon = Icon::orderBy('name')->limit(4)->first();
        $concatenated_string = $this->generateConcatenation(
            $surname, $first_name, $second_name, $yob, $mob
        );

        $hash = $this->generateHash($concatenated_string);
        $kpic_code = $this->KPICGenerator($hash);
        $patient = Patient::create([
            'sep_id' => $sep->id,
            'icon_id' => $icon->id,
            'kpic_code' => $kpic_code,
            'possible_duplicate' => false
        ]);
        $this->storeTrail($patient, $sep, 'Generated');
    }
}
