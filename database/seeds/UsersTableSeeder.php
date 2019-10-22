<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Kennice Kenny',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('london123'),
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'Sally Yates',
            'username' => 'author',
            'email' => 'sally@gmail.com',
            'password' => bcrypt('london123'),
        ]);
    }
}
