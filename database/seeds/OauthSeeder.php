<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OauthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oauth_clients')->insert([
            'id' => '91746251-23fe-40f3-ab4b-cc8c513e7856',
            'name' => 'KPIC Password Grant Client',
            'secret' => 'OepziHwLSD8cthf4fu75KU7KGiK9OjHdU6Tzu7I6',
            'provider' => 'users',
            'redirect' => config('app.url'),
            'personal_access_client' => false,
            'password_client' => true,
            'revoked' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
