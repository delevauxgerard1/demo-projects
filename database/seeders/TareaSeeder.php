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
            "Análisis de Requisitos" => "Realizar el análisis detallado de los requisitos del proyecto.",
            "Definición de Tecnologías" => "Seleccionar las tecnologías que se utilizarán en el desarrollo del proyecto.",
            "Diseño de la Interfaz de Usuario (UI)" => "Crear el diseño visual de la interfaz de usuario.",
            "Diseño de Experiencia de Usuario (UX)" => "Diseñar la experiencia general del usuario en la aplicación.",
            "Desarrollo Frontend" => "Implementar la parte del cliente de la aplicación.",
            "Desarrollo Backend" => "Implementar la lógica del servidor y la base de datos.",
            "Desarrollo de Funcionalidades Específicas" => "Implementar características específicas del proyecto.",
            "Pruebas Unitarias" => "Realizar pruebas para cada unidad individual de código.",
            "Pruebas de Integración" => "Probar la integración entre diferentes partes del sistema.",
            "Despliegue" => "Llevar a cabo el despliegue del proyecto en un entorno de producción.",
            "Monitoreo y Mantenimiento" => "Monitorear el sistema y realizar tareas de mantenimiento regular."
        ];

        foreach ($proyectos as $proyecto) {
            foreach ($tareas as $nombreTarea => $descripcionTarea) {
                Tarea::create([
                    'proyecto_id' => $proyecto->id,
                    'nombre' => $nombreTarea,
                    'descripcion' => $descripcionTarea,
                ]);
            }
        }
    }
}
