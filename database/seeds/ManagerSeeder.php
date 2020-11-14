<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get the predefined roles from the included .json file
        $roles = json_decode(file_get_contents(
            database_path('data/manager.json')
        ));

        // loop roles
        foreach ($roles as $role){
            // Create role
            if(!$db_role = Role::where('name', $role->name)->first()){
                $db_role = Role::create(['name' => $role->name]);
            }

            foreach ($role->permissions as $permission){
                if(!$db_permission = Permission::where('name', $permission)->first()){
                    $db_permission = Permission::create(['name' => $permission]);
                }
                $db_role->givePermissionTo($db_permission);
            }
        }

        // Create manager user
        $user = User::create([
            'name' => 'KPIC Manager',
            'email' => 'manager@example.com',
            'email_verified_at' => now(),
            'activated_at' => now(),
            'password' => Hash::make('Secret1234!')
        ]);

        $user->assignRole('manager');
    }
}
