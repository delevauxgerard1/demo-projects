<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use App\Models\Tarea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TareaSeeder extends Seeder
{
    public function run()
    {
        $proyectos = Proyecto::all();

        $tareas = [
            "Análisis de Requisitos",
            "Definición de Tecnologías",
            "Diseño de la Interfaz de Usuario (UI)",
            "Diseño de Experiencia de Usuario (UX)",
            "Desarrollo Frontend",
            "Desarrollo Backend",
            "Desarrollo de Funcionalidades Específicas",
            "Pruebas Unitarias",
            "Pruebas de Integración",
            "Despliegue",
            "Monitoreo y Mantenimiento"
        ];

        foreach ($proyectos as $proyecto) {
            foreach ($tareas as $nombreTarea) {
                Tarea::create([
                    'proyecto_id' => $proyecto->id,
                    'nombre' => $nombreTarea,
                ]);
            }
        }
    }
}

