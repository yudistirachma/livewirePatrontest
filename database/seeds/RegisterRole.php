<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegisterRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('model_has_roles')->insert([
            [
            'role_id' => '1',
            'model_type' => 'app\User',
            'model_id' => '12101',
            ],
            [
            'role_id' => '1',
            'model_type' => 'app\User',
            'model_id' => '12102',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12103',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12104',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12105',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12106',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12107',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12108',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12109',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12110',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12111',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '12112',
            ],
            [
            'role_id' => '2',
            'model_type' => 'app\User',
            'model_id' => '12113',
            ],
            [
            'role_id' => '2',
            'model_type' => 'app\User',
            'model_id' => '12114',
            ],
            [
            'role_id' => '2',
            'model_type' => 'app\User',
            'model_id' => '12115',
            ],


































        ]);
    }
}
