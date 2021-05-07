<?php

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
        DB::table('users')->insert([
            [
                'id' => '10001',
                'name' => 'rahma yudistira',
                'email' => 'yudistira.anaga@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890123',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '10002',
                'name' => 'imam tantowi',
                'email' => 'pasukanbodrek230@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890123',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true

            ],
            [
                'id' => '10003',
                'name' => 'nazwasihab',
                'email' => 'nazwasihab@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890121',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '10004',
                'name' => 'karni ilias',
                'email' => 'ilias@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890121',
                'ktp' => '1234567890123451',
                'npwp' => '1234567890123451',
                'status' => true

            ],
            [
                'id' => '10005',
                'name' => 'atut',
                'email' => 'atut@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890126',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => false
            ],
        ]);
    }
}
