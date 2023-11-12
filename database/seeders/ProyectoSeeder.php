<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientes = DB::table('clientes')->pluck('nombres', 'id');
        $apellidos = DB::table('clientes')->pluck('apellidos', 'id');

        $clientesConApellidos = [];
        foreach ($clientes as $clienteId => $nombre) {
            $apellido = $apellidos[$clienteId];
            $clientesConApellidos[$clienteId] = $apellido . ' ' . $nombre;
        }

        for ($clienteId = 3; $clienteId <= 20; $clienteId++) {
            $numProyectos = rand(1, 3); // Determina aleatoriamente el número de proyectos (1, 2, o 3)
            
            for ($i = 1; $i <= $numProyectos; $i++) {
                DB::table('proyectos')->insert([
                    'nombre' => 'Proyecto ' . $clientesConApellidos[$clienteId] . ' - ' . $i,
                    'descripcion' => 'Descripción del proyecto ' . $i,
                    'cliente_id' => $clienteId,
                    'fecha_inicio' => now(),
                    'fecha_fin' => now()->addDays(30), // Ajusta la fecha de finalización según tus necesidades
                    'estado_id' => 1, // Asigna el estado que desees
                    'responsable_id' => 1, // Asigna el responsable que desees
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
