<?php

namespace App\Http\Livewire;

use App\Models\Estado;
use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;

class IndexReportes extends Component
{
    public function render()
    {
        $proyectos = Proyecto::where("activo", "=", "1")->get();
        $totalTareasTerminadas = Tarea::where('completada', '=', 1)->count();
        $totalTareasNoTerminadas = Tarea::where('completada', '=', 0)->count();

        $totalTareas = $totalTareasTerminadas + $totalTareasNoTerminadas;
        $porcentajeTerminadas = ($totalTareasTerminadas / $totalTareas) * 100;
        $porcentajeNoTerminadas = ($totalTareasNoTerminadas / $totalTareas) * 100;

        $estados = Estado::all();
        $proyectosPorEstado = [];
        foreach ($estados as $estado) {
            $proyectosPorEstado[$estado->nombre] = Proyecto::where('estado_id', '=', $estado->id)
                ->where('activo', '=', 1)
                ->count();
        }

        $proyectos = Proyecto::where('estado_id', 2)
            ->where('activo', 1)
            ->get();

        $totalIngresosProyectados = 0;

        foreach ($proyectos as $proyecto) {
            $tareasProyecto = Tarea::where('proyecto_id', $proyecto->id)->get();
            $todasTareasTerminadas = $tareasProyecto->every(function ($tarea) {
                return $tarea->completada === 1;
            });

            if ($todasTareasTerminadas) {
                $totalIngresosProyectados += $proyecto->ingresos_proyectados;
            }
        }

        $chartData = [
            'labels' => array_column($estados->toArray(), 'nombre'),
            'datasets' => [
                [
                    'label' => 'Proyectos por Estado',
                    'data' => array_values($proyectosPorEstado),
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 205, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];

        $chartData2 = [
            'labels' => ['Terminadas', 'No Terminadas'],
            'datasets' => [
                [
                    'label' => 'Porcentaje de Tareas',
                    'data' => [$porcentajeTerminadas, $porcentajeNoTerminadas],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.5)',
                    ],
                    'borderColor' => [
                        'white'
                    ],
                    'borderWidth' => 1
                ]
            ]
        ];

        $chartData3 = [
            'labels' => ['Total cobrado'],
            'datasets' => [
                [
                    'label' => 'Total cobrado',
                    'data' => [$totalIngresosProyectados],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.7)',
                    ],
                    'borderColor' => [
                        'white'
                    ],
                    'borderWidth' => 1,
                ],
            ],
        ];

        return view('livewire.index-reportes', compact('proyectos', 'chartData', 'chartData2', 'chartData3'));
    }
}

/*  Colores para los charts
    'rgba(75, 192, 192, 0.7)',
    'rgba(255, 99, 132, 0.7)',
    'rgba(255, 205, 86, 0.7)',
    'rgba(54, 162, 235, 0.7)',
    'rgba(255, 159, 64, 0.7)',
    'rgba(153, 102, 255, 0.7)',
    'rgba(255, 87, 51, 0.7)',
    'rgba(75, 192, 50, 0.7)',
    'rgba(255, 128, 0, 0.7)',
    'rgba(0, 102, 204, 0.7)' */
