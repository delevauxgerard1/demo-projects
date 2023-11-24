<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    /**
     * Array de profesiones disponibles.
     *
     * @var array
     */
    protected $profesiones = [
        'Médico',
        'Profesor',
        'Ingeniero',
        'Abogado',
        'Programador',
        'Diseñador gráfico',
        'Chef',
        'Escritor',
        'Artista',
        'Psicólogo',
        'Arquitecto',
        'Científico',
        'Enfermero/a',
        'Contador',
        'Músico'
        // Añade más profesiones si lo deseas
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_AR');

        for ($i = 0; $i < 20; $i++) {
            $nombreCompleto = $faker->firstName;
            $nombre = explode(' ', $nombreCompleto)[0]; // Tomar solo la primera palabra

            $apellido = $faker->lastName;

            DB::table('clientes')->insert([
                'nombres' => $nombre,
                'apellidos' => $apellido,
                'domicilio' => $faker->address,
                'tel_movil' => $faker->phoneNumber,
                'profesion' => $this->profesiones[array_rand($this->profesiones)],
                'email' => strtolower($nombre . '.' . $apellido . '@example.com'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
