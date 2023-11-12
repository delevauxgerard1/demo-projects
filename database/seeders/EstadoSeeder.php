<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            [
                'nombre' => 'En Curso'
            ],
            [
                'nombre' => 'Completado'
            ],
            [
                'nombre' => 'En Pausa'
            ],
            [
                'nombre' => 'Cancelado'
            ]
        ]);
    }
}
