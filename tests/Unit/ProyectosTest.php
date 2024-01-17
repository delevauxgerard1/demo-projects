<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Http\Livewire\IndexProyectos;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Proyecto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProyectosTest extends TestCase
{
    use RefreshDatabase;

    public function test_se_renderiza_el_componente_con_paginacion()
    {
        $component = new IndexProyectos();
        $component->paginas = 10;

        $view = $component->render();

        $this->assertNotNull($view);
        $this->assertInstanceOf(\Illuminate\View\View::class, $view);
        $this->assertArrayHasKey('proyectos', $view->getData());
        $this->assertArrayHasKey('proyectosCount', $view->getData());
    }

    public function test_se_encuentra_el_proyecto_buscandolo()
    {
        $cliente = Cliente::create([
            'nombres' => 'Pepe',
            'apellidos' => 'Honguito',
            'email' => 'pepe.honguito@example.com',
            'domicilio' => '123 calle random',
            'tel_movil' => '3515689384',
            'profesion' => 'Developer',
            'activo' => 1,
        ]);

        $estado =  Estado::create([
            'nombre' => 'En Curso'
        ]);

        Proyecto::create([
            'nombre' => 'Proyecto de ejemplo',
            'descripcion' => 'Descripcion proyecto',
            'cliente_id' => $cliente->id,
            'fecha_inicio' => now(),
            'estado_id' => $estado->id
        ]);

        $component = new IndexProyectos();
        $component->search = $cliente->nombres;
        $view = $component->render();

        $this->assertNotNull($view);
        $this->assertInstanceOf(\Illuminate\View\View::class, $view);
        $this->assertArrayHasKey('proyectos', $view->getData());
        $this->assertArrayHasKey('proyectosCount', $view->getData());

        $proyectos = $view->getData()['proyectos'];
        $foundProyecto = false;

        foreach ($proyectos as $proyecto) {
            if (stripos($proyecto->nombre, 'Proyecto de ejemplo') !== false) {
                $foundProyecto = true;
                break;
            }
        }

        $this->assertTrue($foundProyecto, 'No se encontró al proyecto "Proyecto de ejemplo" en los resultados de la búsqueda.');
    }
}
