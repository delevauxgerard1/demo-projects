<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_AR');

        for ($i = 0; $i < 20; $i++) {
            DB::table('clientes')->insert([
                'nombres' => $faker->firstName,
                'apellidos' => $faker->lastName,
                'domicilio' => $faker->address,
                'tel_movil' => $faker->phoneNumber,
                'profesion' => $faker->jobTitle,
                'email' => $faker->unique()->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
