<?php

use AutoKit\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'title' => 'user'
        ]);
        Role::create([
            'title' => 'admin'
        ]);
    }
}
