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
                'id' => '12101',
                'name' => 'rahma yudistira',
                'email' => 'yudistira.anaga@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '1234567890123',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12102',
                'name' => 'Imam tantowi',
                'email' => 'aimelhazmi@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '081387964150',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12103',
                'name' => 'Abdul Muhit',
                'email' => 'amuhit.51@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '085695054604',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12104',
                'name' => 'Samsul Bahri',
                'email' => 'bahri7303@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12105',
                'name' => 'Hamdu Alfaza',
                'email' => 'HamduAlfaza@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12106',
                'name' => 'Hendra malulitua',
                'email' => 'Hendramalulitua@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12107',
                'name' => 'Setia adi wangsa',
                'email' => 'setiaadiwangsa@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12108',
                'name' => 'ahmad baihaki',
                'email' => 'ahmadbaihaki@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12109',
                'name' => 'Aswari',
                'email' => 'Aswari@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12110',
                'name' => 'Wawan Saputra',
                'email' => 'wawanSaputra@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12111',
                'name' => 'Ilyas Iskandar',
                'email' => 'ilyasIskandar@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12112',
                'name' => 'Iif Fathulatif',
                'email' => 'IifFathulatif@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12113',
                'name' => 'Aldy Mandagi',
                'email' => 'AldyMandagi@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],
            [
                'id' => '12114',
                'name' => 'Vredo adisyah',
                'email' => 'VredoAdisyah@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],        
            [
                'id' => '12115',
                'name' => 'Roy Goozly',
                'email' => 'RoyGoozly@gmail.com',
                'password' => Hash::make('password'),
                'phoneNum' => '083813852673',
                'ktp' => '1234567890123456',
                'npwp' => '1234567890123456',
                'status' => true
            ],        
        ]);
    }
}
