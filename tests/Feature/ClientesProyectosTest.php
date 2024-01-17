<?php

namespace Tests\Feature;

use App\Http\Livewire\Proyecto\IndexClientesProyectos;
use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ClientesProyectosTest extends TestCase
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

    private function autenticarUsuario()
    {
        return $this->actingAs(User::factory()->state([
            'name' => 'usuario1',
            'email' => 'usuario1@usuario.com',
            'password' => Hash::make('password')
        ])->create());
    }

    public function test_muestra_al_cliente()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id
        ])
            ->assertStatus(200)
            ->assertSee('Cliente: ' . $cliente->apellidos . ' ' . $cliente->nombres);
    }

    public function test_muestra_el_proyecto_del_cliente()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();
        $proyecto = Proyecto::where('cliente_id', $cliente->id)
            ->where("activo", "=", "1")->first();

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Cliente: ' . $cliente->apellidos . ' ' . $cliente->nombres)
            ->assertSee($proyecto->nombre);
    }

    public function test_muestra_boton_generar_factura_cuando_todas_las_tareas_estan_terminadas()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();
        $proyecto = Proyecto::where('cliente_id', $cliente->id)
            ->where("activo", "=", "1")->first();
        $tareas = Tarea::where('proyecto_id', $proyecto->id)->get();

        foreach ($tareas as $tarea) {
            $tarea->update(['completada' => 1]);
        }

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Generar factura');
    }

    public function test_no_se_muestra_boton_generar_factura_porque_hay_tareas_incompletas()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();
        $proyecto = Proyecto::where('cliente_id', $cliente->id)
            ->where("activo", "=", "1")->first();
        $tareas = Tarea::where('proyecto_id', $proyecto->id)->get();

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Generar factura');
    }

    public function test_se_muestra_porcentaje_de_finalizacion_correcto()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();
        $proyecto = Proyecto::where('cliente_id', $cliente->id)
            ->where("activo", "=", "1")->first();

        $tareas = Tarea::where('proyecto_id', $proyecto->id)
            ->where('activo', 1)
            ->get();

        $completedTasks = $tareas->take(5);
        foreach ($completedTasks as $tarea) {
            $tarea->update(['completada' => 1]);
        }

        $incompleteTasks = $tareas->skip(5)->take(6);
        foreach ($incompleteTasks as $tarea) {
            $tarea->update(['completada' => 0]);
        }

        $totalTareas = $tareas->count();
        $tareasFinalizadas = $tareas->where('completada', true)->count();
        $porcentaje = ($totalTareas > 0) ? round(($tareasFinalizadas / $totalTareas) * 100) : 0;

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Porcentaje de tareas finalizadas: ' . number_format($porcentaje, 0) . ' %');
    }

    public function test_actualiza_porcentaje_completacion_al_actualizar_tarea_incompleta_a_completada()
    {
        $this->autenticarUsuario();

        $cliente = Cliente::first();
        $proyecto = Proyecto::where('cliente_id', $cliente->id)
            ->where("activo", "=", "1")->first();

        Tarea::where('proyecto_id', $proyecto->id)->limit(6)->update(['completada' => 0]);

        $tareas = Tarea::where('proyecto_id', $proyecto->id)
            ->where('activo', 1)
            ->get();

        $totalTareas = $tareas->count();
        $tareasFinalizadas = $tareas->where('completada', true)->count();
        $porcentaje = ($totalTareas > 0) ? round(($tareasFinalizadas / $totalTareas) * 100) : 0;

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Porcentaje de tareas finalizadas: ' . number_format($porcentaje, 0) . ' %');

        $tareaIncompletaParaActualizar = $tareas->where('completada', 0)->first();
        $tareaIncompletaParaActualizar->update(['completada' => 1]);

        $tareasFinalizadas = $tareas->where('completada', true)->count();
        $porcentajeDespuesDeActualizar = ($totalTareas > 0) ? round(($tareasFinalizadas / $totalTareas) * 100) : 0;

        Livewire::test(IndexClientesProyectos::class, [
            'clienteid' => $cliente->id,
            'proyectoid' => $proyecto->id,
        ])
            ->assertStatus(200)
            ->assertSee('Porcentaje de tareas finalizadas: ' . number_format($porcentajeDespuesDeActualizar, 0) . ' %');
    }
}
