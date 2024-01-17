<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\Cliente\IndexCliente;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ClientesTest extends TestCase
{
    use RefreshDatabase;

    /* Usuario autenticado */
    private function autenticarUsuario()
    {
        return $this->actingAs(User::factory()->state([
            'name' => 'usuario1',
            'email' => 'usuario1@usuario.com',
            'password' => Hash::make('password')
        ])->create());
    }

    /* Método para crear un cliente con valores predeterminados */
    private function crearCliente($overrides = [])
    {
        return Cliente::create(array_merge([
            'nombres' => 'Pepe',
            'apellidos' => 'Honguito',
            'email' => 'pepe.honguito@example.com',
            'domicilio' => '123 calle random',
            'tel_movil' => '3515689384',
            'profesion' => 'Developer',
            'activo' => 1,
        ], $overrides));
    }

    /* Se valida los campos del cliente */
    public function test_se_validan_campos_requeridos()
    {
        $this->autenticarUsuario();

        Livewire::test(IndexCliente::class)
            ->call('crearCliente')
            ->assertHasErrors(['nombres', 'apellidos', 'email'])
            ->assertSee('Debe ingresar un Nombre.')
            ->assertSee('Debe ingresar un Apellido.')
            ->assertSee('Debe ingresar un email.');
    }

    /* Se valida que el mail sea único */
    public function test_se_valida_que_el_email_sea_unico()
    {
        $this->autenticarUsuario();

        $this->crearCliente(['email' => 'existing.user@example.com']);

        Livewire::test(IndexCliente::class)
            ->set('email', 'existing.user@example.com')
            ->call('crearCliente')
            ->assertHasErrors(['email'])
            ->assertSee('Ese email ya existe.');
    }

    /* Nuevo cliente es creado */
    public function test_se_crea_un_nuevo_cliente()
    {
        $this->autenticarUsuario();

        Livewire::test(IndexCliente::class)
            ->set('nombres', 'John')
            ->set('apellidos', 'Doe')
            ->set('email', 'john.doe@example.com')
            ->set('domicilio', '123 Main St')
            ->set('tel_movil', '555-1234')
            ->set('profesion', 'Developer')
            ->call('crearCliente');

        $this->assertDatabaseHas('clientes', [
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'email' => 'john.doe@example.com',
            'domicilio' => '123 Main St',
            'tel_movil' => '555-1234',
            'profesion' => 'Developer',
            'activo' => 1,
        ]);
    }

    /* Se abre el modal con la data del cliente correcta */
    public function test_se_abre_el_modal_de_edicion_con_los_datos_correctos()
    {
        $this->autenticarUsuario();

        $cliente = $this->crearCliente();

        Livewire::test(IndexCliente::class)
            ->call('abrirModalEdicion', $cliente->id)
            ->assertSet('clienteIdToEdit', $cliente->id)
            ->assertSet('editNombres', $cliente->nombres)
            ->assertSet('editApellidos', $cliente->apellidos)
            ->assertSet('editEmail', $cliente->email)
            ->assertSet('editDomicilio', $cliente->domicilio)
            ->assertSet('editTel_movil', $cliente->tel_movil)
            ->assertSet('editProfesion', $cliente->profesion)
            ->assertSet('clienteModalOpen', true)
            ->assertSee($cliente->nombres)
            ->assertSee($cliente->apellidos)
            ->assertSee($cliente->email)
            ->assertSee($cliente->domicilio)
            ->assertSee($cliente->tel_movil)
            ->assertSee($cliente->profesion);
    }

    /* Se actualiza correctamente el cliente */
    public function test_se_actualiza_el_cliente_correctamete()
    {
        $this->autenticarUsuario();

        $cliente = $this->crearCliente();

        Livewire::test(IndexCliente::class)
            ->set('clienteIdToEdit', $cliente->id)
            ->set('editNombres', 'Updated John')
            ->set('editApellidos', 'Updated Doe')
            ->set('editEmail', 'updated.john.doe@example.com')
            ->set('editDomicilio', '456 Secondary St')
            ->set('editTel_movil', '555-5678')
            ->set('editProfesion', 'Senior Developer')
            ->call('actualizarCliente')
            ->assertSet('updatingCliente', false)
            ->assertSet('editNombres', null)
            ->assertSet('editApellidos', null)
            ->assertSet('editEmail', null)
            ->assertSet('editDomicilio', null)
            ->assertSet('editTel_movil', null)
            ->assertSet('editProfesion', null)
            ->assertSet('clienteModalOpen', false)
            ->assertEmitted('render');

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nombres' => 'Updated John',
            'apellidos' => 'Updated Doe',
            'email' => 'updated.john.doe@example.com',
            'domicilio' => '456 Secondary St',
            'tel_movil' => '555-5678',
            'profesion' => 'Senior Developer',
        ]);
    }

    /* No se puede actualizar cliente cuando faltan campos obligatorios */
    public function test_se_valida_campos_cuando_se_quiere_actualizar_cliente_sin_campos_obligatorios()
    {
        $this->autenticarUsuario();

        $cliente = $this->crearCliente();

        Livewire::test(IndexCliente::class)
            ->set('clienteIdToEdit', $cliente->id)
            ->set('editNombres', '')
            ->call('actualizarCliente')
            ->assertHasErrors(['editNombres'])
            ->assertSee('Debe ingresar un Nombre.');

        $this->assertDatabaseMissing('clientes', [
            'id' => $cliente->id,
            'nombres' => '',
        ]);
    }

    /* Se confirma y borra correctamente al cliente */
    public function test_se_confirma_y_borra_correctamente_al_cliente()
    {
        $this->autenticarUsuario();

        $cliente = $this->crearCliente();

        Livewire::test(IndexCliente::class)
            ->call('deleteConfirmation', $cliente->id)
            ->call('deleteCliente')
            ->assertEmitted('render')
            ->assertEmitted('alert', 'Cliente borrado correctamente!');

        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'activo' => 0,
        ]);
    }

    /* Redirige a la página de proyectos del cliente correctamente */
    public function test_redirige_a_la_pagina_de_proyectos_del_cliente_correctamente()
    {
        $this->autenticarUsuario();

        $cliente = $this->crearCliente();

        Livewire::test(IndexCliente::class)
            ->call('clientesProyectos', $cliente->id)
            ->assertRedirect('/cliente/proyectos/' . $cliente->id);
    }
}
