<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $admins = array(
            array('id' => '1','name' => 'Admin','email' => 'admin@admin.com','password' => Hash::make(123456)),
        );

        DB::table('users')->insert($admins);
    }
}

