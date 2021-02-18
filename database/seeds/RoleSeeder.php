<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'pimpinan redaktur',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'redaktur',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'jurnalis',
            'guard_name' => 'web',
        ]);
    }
}
