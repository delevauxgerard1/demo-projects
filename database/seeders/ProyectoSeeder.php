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

        for ($clienteId = 1; $clienteId <= 20; $clienteId++) {
            $numProyectos = rand(1, 3);
            
            for ($i = 1; $i <= $numProyectos; $i++) {
                // Nombre del proyecto inventado
                $nombreProyecto = 'Proyecto ' . $this->generarNombreProyecto() . ' - ' . $i;

                DB::table('proyectos')->insert([
                    'nombre' => $nombreProyecto,
                    'descripcion' => 'Descripción del proyecto ' . $i,
                    'cliente_id' => $clienteId,
                    'fecha_inicio' => now(),
                    'fecha_fin' => now()->addDays(30),
                    'estado_id' => 1,
                    'responsable_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Genera un nombre aleatorio para el proyecto.
     *
     * @return string
     */
    private function generarNombreProyecto()
{
    $rubros = [
        'Tecnología de la Información (TI)',
        'Salud y Medicina',
        'Educación',
        'Finanzas y Contabilidad',
        'Servicios Financieros',
        'Manufactura',
        'Agricultura',
        'Alimentación y Bebidas',
        'Comercio Minorista',
        'Comercio Mayorista',
        'Construcción',
        'Energía y Recursos Naturales',
        'Medio Ambiente',
        'Inmobiliaria',
        'Arte y Entretenimiento',
        'Moda y Diseño',
        'Investigación y Desarrollo',
        'Consultoría',
        'Servicios Legales',
        'Servicios de Ingeniería',
        'Turismo y Hospitalidad',
        'Transporte y Logística',
        'Telecomunicaciones',
        'Servicios Públicos',
        'Servicios Sociales y Comunitarios',
        'Deportes y Recreación',
        'Publicidad y Marketing',
        'Medios de Comunicación y Periodismo',
        'Tecnología Verde (Eco-Tecnología)',
        'Ciencia y Tecnología'
    ];

    $nombreAleatorio = $rubros[array_rand($rubros)];

    return $nombreAleatorio;
}

}
