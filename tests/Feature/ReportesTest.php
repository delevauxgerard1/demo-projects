<?php

namespace Tests\Feature;

use App\Http\Livewire\IndexReportes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Estado;
use App\Models\Proyecto;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;


class ReportesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function test_componente_se_renderiza_sin_errores()
    {
        $usuario = User::factory()->state([
            'name' => 'usuario1',
            'email' => 'usuario1@usuario.com',
            'password' => Hash::make('password')
        ])->create();

        $this->actingAs($usuario);

        $response = $this->get('/index-reportes');
        $response->assertStatus(200);
    }

    public function test_index_se_muestran_los_charts()
    {
        $this->artisan('migrate');

        Livewire::test(IndexReportes::class)
            ->assertSee('Proyectos por Estado')
            ->assertSee('Porcentaje de Tareas')
            ->assertSee('Total cobrado')
            ->assertViewHas('proyectos')
            ->assertViewHas('chartData')
            ->assertViewHas('chartData2')
            ->assertViewHas('chartData3');
    }

    public function test_proyectos_se_filtran_por_estado()
    {
        Livewire::test(IndexReportes::class)
            ->assertViewHas('proyectos', Proyecto::where('estado_id', 2)->where('activo', 1)->get());
    }

    public function test_calculos_de_porcentaje_son_correctos_en_grafico_2()
    {
        $proyectos = Proyecto::where("activo", "=", "1")->get();
        $totalTareasTerminadas = Tarea::where('completada', '=', 1)->count();
        $totalTareasNoTerminadas = Tarea::where('completada', '=', 0)->count();

        $totalTareas = $totalTareasTerminadas + $totalTareasNoTerminadas;
        $porcentajeTerminadas = ($totalTareasTerminadas / $totalTareas) * 100;
        $porcentajeNoTerminadas = ($totalTareasNoTerminadas / $totalTareas) * 100;

        Livewire::test(IndexReportes::class)
            ->assertViewHas('chartData2', [
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
            ]);
    }


    public function test_total_del_grafico_3_es_correcto()
    {
        $proyectos = Proyecto::where("activo", "=", "1")->get();
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

        Livewire::test(IndexReportes::class)
            ->assertViewHas('chartData3', [
                'labels' => ['Total cobrado'],
                'datasets' => [
                    [
                        'label' => 'Total cobrado',
                        'data' => [$totalIngresosProyectados],
                        'backgroundColor' => ['rgba(54, 162, 235, 0.7)'],
                        'borderColor' => ['white'],
                        'borderWidth' => 1,
                    ],
                ],
            ]);
    }
}
