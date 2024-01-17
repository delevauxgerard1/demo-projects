<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Http\Livewire\Cliente\IndexCliente;
use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    /* Se renderiza el componente con la paginación */
    public function test_se_renderiza_el_componente_con_paginacion()
    {
        $component = new IndexCliente();
        $component->paginas = 10;

        $view = $component->render();

        $this->assertNotNull($view);
        $this->assertInstanceOf(\Illuminate\View\View::class, $view);
        $this->assertArrayHasKey('clientes', $view->getData());
        $this->assertArrayHasKey('clientesCount', $view->getData());
    }

    public function test_se_encuentra_al_cliente_buscandolo()
    {
        Cliente::create([
            'nombres' => 'Pepe',
            'apellidos' => 'Honguito',
            'email' => 'pepe.honguito@example.com',
            'domicilio' => '123 calle random',
            'tel_movil' => '3515689384',
            'profesion' => 'Developer',
            'activo' => 1,
        ]);

        $component = new IndexCliente();
        $component->search = 'Pepe';
        $view = $component->render();

        $this->assertNotNull($view);
        $this->assertInstanceOf(\Illuminate\View\View::class, $view);
        $this->assertArrayHasKey('clientes', $view->getData());
        $this->assertArrayHasKey('clientesCount', $view->getData());

        $clientes = $view->getData()['clientes'];
        $foundPepe = false;

        foreach ($clientes as $cliente) {
            if (stripos($cliente->nombres, 'Pepe') !== false) {
                $foundPepe = true;
                break;
            }
        }

        $this->assertTrue($foundPepe, 'No se encontró a John en los resultados de la búsqueda.');
    }
}
