<?php

use App\User;
use Illuminate\Database\Seeder;

class UpdatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NewRolesTableSeeder::class
        ]);

        foreach (User::all() as $user){
            $user->update([
                'password_activated_at' => now()
            ]);
        }
    }
}
