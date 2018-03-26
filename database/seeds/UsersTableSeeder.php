<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Phạm Mạnh Thắng',
            'email' => 'phammanhthang95@gmail.com',
            'is_root' => 'yes',
            'password' => bcrypt('12345678'),
        ]);
    }
}
