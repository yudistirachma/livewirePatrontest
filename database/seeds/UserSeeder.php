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
            'name' => 'rahma yudistira',
            'email' => 'yudistira.anaga@gmail.com',
            'password' => Hash::make('password'),
            'phoneNum' => '1234567890123',
            'ktp' => '1234567890123456',
            'kk' => '1234567890123456',
            'npwp' => '1234567890123456'
        ]);

        DB::table('users')->insert([
            'name' => 'imam tantowi',
            'email' => 'pasukanbodrek230@gmail.com',
            'password' => Hash::make('password'),
            'phoneNum' => '1234567890123',
            'ktp' => '1234567890123456',
            'kk' => '1234567890123456',
            'npwp' => '1234567890123456'
        ]);
    }
}
