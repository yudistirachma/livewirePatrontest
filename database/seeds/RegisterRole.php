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
            'model_id' => '10001',
            ],
            [
            'role_id' => '2',
            'model_type' => 'app\User',
            'model_id' => '10002',
            ],
            [
            'role_id' => '2',
            'model_type' => 'app\User',
            'model_id' => '10003',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '10004',
            ],
            [
            'role_id' => '3',
            'model_type' => 'app\User',
            'model_id' => '10005',
            ],
        ]);
    }
}
