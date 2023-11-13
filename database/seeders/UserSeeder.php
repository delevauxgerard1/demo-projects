<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin1234')
            ],
            [
                'name' => 'Project Leader 1',
                'email' => 'projectleader1@gmail.com',
                'password' => Hash::make('projectleader1234')
            ],
            [
                'name' => 'Project Leader 2',
                'email' => 'projectleader2@gmail.com',
                'password' => Hash::make('projectleader1234')
            ],
            [
                'name' => 'Desarrollador 1',
                'email' => 'desarrollador1@gmail.com',
                'password' => Hash::make('desarrollador1234')
            ],
            [
                'name' => 'Desarrollador 2',
                'email' => 'desarrollador2@gmail.com',
                'password' => Hash::make('desarrollador1234')
            ],
        ]);
    }
}
