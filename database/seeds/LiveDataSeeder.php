<?php

use App\AuditTrail;
use App\Icon;
use App\Patient;
use App\SepType;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class LiveDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://kpic-generator.com/export?password=Mathayo');

        $data = json_decode(json_encode($response->json()));

        $this->handleSeps($data->seps);
        $this->handleUsers($data->users);
        $this->handlePatients($data->patients);
    }

    public function handleSeps($data)
    {
        foreach ($data as $datum){
            if(!in_array($datum->id,['7dc91638-e6db-4011-a86a-9a48c814035d', '47cabcd4-60b2-42c3-ae97-9c65af62b93e', 'fc0bb52a-ffa7-4bde-8271-af5f96521bc1'])){
                DB::table('seps')->insert([
                    'id' => $datum->id,
                    'name' => $datum->name,
                    'code' => $datum->code,
                    'type_id' => SepType::where('code', $datum->type)->first()->id,
                    'created_at' => Carbon::parse($datum->created_at),
                    'updated_at' => Carbon::parse($datum->updated_at)
                ]);
            }
        }
    }

    public function handleUsers($data)
    {
        // Create super admin user
        $user = User::create([
            'name' => 'KPIC Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('Secret1234!')
        ]);

        $user->assignRole('super admin');

        foreach ($data as $datum){
            $sep_id = $this->getSepId($datum->sep_id);
            $user = User::create([
                'name' => $datum->name,
                'email' => $datum->email,
                'password' => $datum->password,
                'sep_id' => $sep_id,
                'activated_at' => now(),
                'created_at' => Carbon::parse($datum->created_at),
                'updated_at' => Carbon::parse($datum->updated_at)
            ]);

            foreach ($datum->roles as $role){
                $user->assignRole($role);
            }
        }
    }

    public function getSepId($sep_id)
    {
        switch ($sep_id){
            case '7dc91638-e6db-4011-a86a-9a48c814035d':
            case '47cabcd4-60b2-42c3-ae97-9c65af62b93e':
            case 'fc0bb52a-ffa7-4bde-8271-af5f96521bc1':
                return 'c2c342d2-5032-41c0-9a5b-db6a4c12b189';
            default:
                return $sep_id;
        }
    }

    public function handlePatients($data)
    {
        foreach ($data as $datum){
            $sep_id = $this->getSepId($datum->sep_id);
            $patient = Patient::create([
                'kpic_code' => $datum->kpic_code,
                'sep_id' => $sep_id,
                'icon_id' => Icon::whereCode($datum->icon)->first()->id,
                'possible_duplicate' => false,
                'created_at' => Carbon::parse($datum->created_at),
                'updated_at' => Carbon::parse($datum->updated_at)
            ]);

            foreach ($datum->trails as $trail){
                $sep_id = $this->getSepId($trail->sep_id);
                $patient->trails()->create([
                    'sep_id' => $sep_id,
                    'user_id' => User::whereEmail($trail->user)->first()->id,
                    'action' => $trail->action,
                    'created_at' => Carbon::parse($trail->created_at),
                    'updated_at' => Carbon::parse($trail->updated_at)
                ]);
            }

        }
    }
}
