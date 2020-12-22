<?php

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
    }
}
