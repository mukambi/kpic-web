<?php

use App\AuditTrail;
use App\Http\Traits\GeneratesKPIC;
use App\Icon;
use App\Patient;
use App\Sep;
use App\User;
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
        $fake_kpic = 30000;
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

        factory(App\Patient::class, $fake_kpic)->create()->each(function ($patient){
            AuditTrail::create([
                'sep_id' => $patient->sep->id,
                'patient_id' => $patient->id,
                'user_id' => User::first()->id,
                'action' => 'Generated'
            ]);
        });
    }

    public function generatedSeedKPIC($sep, $surname, $first_name, $second_name, $yob, $mob)
    {
        $admin = User::query()->where('email', 'admin@example.com')->first();
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
            'possible_duplicate' => false,
            'creator_id' => $admin->id
        ]);
        $this->storeTrail($patient, $sep, 'Generated');
    }
}
