<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\IndexProyectos;
use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProyectosTest extends TestCase
{
    use RefreshDatabase;

    private $usuario;

    protected function setUp(): void
    {
        parent::setUp();

        $this->usuario = User::factory()->state([
            'name' => 'usuario1',
            'email' => 'usuario1@usuario.com',
            'password' => Hash::make('password')
        ])->create();
    }

    private function autenticarUsuario()
    {
        return $this->actingAs($this->usuario);
    }

    private function crearEstado()
    {
        return Estado::create([
            'nombre' => 'En Curso'
        ]);
    }

    private function crearCliente()
    {
        $email = 'pepe.honguito@example.com';

        $existingCliente = Cliente::where('email', $email)->first();

        if ($existingCliente) {
            return $existingCliente;
        }

        return Cliente::create([
            'nombres' => 'Pepe',
            'apellidos' => 'Honguito',
            'email' => $email,
            'domicilio' => '123 calle random',
            'tel_movil' => '3515689384',
            'profesion' => 'Developer',
            'activo' => 1,
        ]);
    }


    private function crearProyecto($overrides = [])
    {
        $cliente = $this->crearCliente();
        $estado = $this->crearEstado();
        $usuarioResponsable = User::factory()->create();

        $this->autenticarUsuario();

        return Proyecto::create(array_merge([
            'nombre' => 'Proyecto de ejemplo',
            'descripcion' => 'Descripcion proyecto',
            'cliente_id' => $cliente->id,
            'fecha_inicio' => now(),
            'estado_id' => $estado->id,
            'responsable_id' => $usuarioResponsable->id,
        ], $overrides));
    }


    public function test_se_validan_campos_requeridos()
    {
        $this->autenticarUsuario();

        Livewire::test(IndexProyectos::class)
            ->call('crearProyecto')
            ->assertHasErrors(['nombre', 'cliente_id'])
            ->assertSee('Debe ingresar un Nombre.')
            ->assertSee('Debe poseer un cliente.');
    }

    public function test_se_crea_un_nuevo_proyecto()
    {
        $this->autenticarUsuario();
        $estado = $this->crearEstado();
        $cliente = $this->crearCliente();

        Livewire::test(IndexProyectos::class)
            ->set('nombre', 'Nuevo Proyecto')
            ->set('descripcion', 'Descripcion Nuevo Proyecto')
            ->set('cliente_id', $cliente->id)
            ->set('estado_id', $estado->id)
            ->call('crearProyecto');

        $this->assertDatabaseHas('proyectos', [
            'nombre' => 'Nuevo Proyecto',
            'descripcion' => 'Descripcion Nuevo Proyecto',
            'cliente_id' => $cliente->id,
            'estado_id' => $estado->id
        ]);
    }

    public function test_se_abre_el_modal_de_edicion_con_los_datos_correctos()
    {
        $proyecto = $this->crearProyecto();

        Livewire::test(IndexProyectos::class)
            ->call('abrirModalEdicion', $proyecto->id)
            ->assertSet('proyectoIdToEdit', $proyecto->id)
            ->assertSet('editnombre', $proyecto->nombre)
            ->assertSet('editcliente_id', $proyecto->cliente_id)
            ->assertSet('proyectoModalOpen', true)
            ->assertSee($proyecto->nombre)
            ->assertSee($proyecto->cliente_id);
    }

    public function test_se_actualiza_el_proyecto_correctamente()
    {
        $this->autenticarUsuario();
        $proyecto = $this->crearProyecto();
        $cliente = $this->crearCliente();

        Livewire::test(IndexProyectos::class)
            ->set('proyectoIdToEdit', $proyecto->id)
            ->set('editnombre', 'Proyecto Actualizado')
            ->set('editcliente_id', $cliente->id)
            ->set('editfecha_inicio', $proyecto->fecha_inicio)
            ->call('actualizarProyecto');

        $this->assertDatabaseHas('proyectos', [
            'id' => $proyecto->id,
            'nombre' => 'Proyecto Actualizado',
            'cliente_id' => $cliente->id,
        ]);
    }

    public function test_se_confirma_y_borra_correctamente_el_proyecto()
    {
        $this->autenticarUsuario();
        $proyecto = $this->crearProyecto();

        Livewire::test(IndexProyectos::class)
            ->call('deleteConfirmation', $proyecto->id)
            ->call('deleteProyecto')
            ->assertEmitted('render')
            ->assertEmitted('alert', 'Proyecto borrado correctamente!');

        $this->assertDatabaseHas('proyectos', [
            'id' => $proyecto->id,
            'activo' => 0,
        ]);
    }

    public function test_redirige_a_la_pagina_del_proyeco_correctamente()
    {
        $this->autenticarUsuario();
        $proyecto = $this->crearProyecto();

        Livewire::test(IndexProyectos::class)
            ->call('clientesProyectos', $proyecto->id)
            ->assertRedirect('/cliente/proyectos/' . $proyecto->cliente_id . '/' . $proyecto->id);
    }
}
