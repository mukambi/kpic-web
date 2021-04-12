<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PastUpdatesSeeder extends Seeder
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
            database_path('data/new_roles.json')
        ));

        // loop roles
        foreach ($roles as $role){
            // Create role
            $db_role = Role::query()->firstOrCreate([
                'name' => $role->name
            ]);

            foreach ($role->permissions as $permission){
                // Create Permission
                $db_permission = Permission::query()->firstOrCreate([
                    'name' => $permission
                ]);

                // Assign Permission
                $db_role->givePermissionTo($db_permission);
            }
        }

        foreach (User::all() as $user){
            $user->update([
                'password_activated_at' => now()
            ]);
        }
    }
}
