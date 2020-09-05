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
             SepTypeTableSeeder::class,
             PcnTableSeeder::class,
             RoleTableSeeder::class,
             UserTableSeeder::class,
             SepTableSeeder::class,
             OauthSeeder::class,
             KPICTableSeeder::class
         ]);
    }
}
