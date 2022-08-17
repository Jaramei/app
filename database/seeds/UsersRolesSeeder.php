<?php

use Illuminate\Database\Seeder;


class UsersRolesSeeder extends Seeder

{

    public function run()
    {
        DB::table('users_roles')->insert([
                'user_id' => 1,
                'role_id'=>1,
            ]);
    }

}