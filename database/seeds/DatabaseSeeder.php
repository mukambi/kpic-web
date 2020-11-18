<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RegionTableSeeder::class,
             IconsTableSeeder::class,
             SepTypeTableSeeder::class,
             PcnTableSeeder::class,
             RoleTableSeeder::class,
             OauthSeeder::class,
         ]);

         if (config('settings.live_data')){
             $this->call([
                 LiveDataSeeder::class
             ]);
         } else {
             $this->call([
                 UserTableSeeder::class,
                 SepTableSeeder::class,
                 KPICTableSeeder::class
             ]);
         }
    }
}
