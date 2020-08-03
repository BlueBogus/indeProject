<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            0 => 'Admin',
            1 => 'User'
        ];

        foreach ($roles as $id => $role_name) {
            $role = new \App\UserRole();
            $role->id = $id;
            $role->name = $role_name;
            $role->save();
        }
    }
}
