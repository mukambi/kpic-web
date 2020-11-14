<?php

use App\Region;
use App\Sep;
use App\SepType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SepTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sep = Sep::create([
            'name' => 'Lira Regional Referral Hospital',
            'code' => 16,
            'type_id' => SepType::where('code', 'F')->first()->id,
            'region_id' => Region::first()->id
        ]);
        $user = $sep->users()->create([
            'name' => 'Lira Regional Referral Hospital User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('Secret1234!')
        ]);
        $user->assignRole('user');
    }
}
