<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCliente extends Component
{
    use WithPagination;

    public $paginas = 15;
    public $sort = 'id';
    public $direction = 'desc';

    protected $listeners = ['render','deleteConfirmed'=>'deleteCliente'];

    public function render()
    {
        $clientes = Cliente::where("activo", "=", "1")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginas);

        $clientesCount = Cliente::where("activo", "=", "1")->count();

        return view('livewire.cliente.index-cliente', compact('clientes', 'clientesCount'));
    }

    public $nombres, $apellidos, $email, $domicilio, $tel_movil, $profesion;

    public $creatingCliente, $modalOpen = false;

    public function crearCliente()
    {
        $this->creatingCliente = true;

        $this->validate(
            [
                'nombres' => 'required',
                'apellidos' => 'required',
                'email' => 'required|unique:clientes'
            ],
            [
                'nombres.required' => 'Debe ingresar un Nombre.',
                'apellidos.required' => 'Debe ingresar un Apellido.',
                'email.required' => 'Debe ingresar un email.',
                'email.unique' => 'Ese email ya existe.'
            ]
        );

        Cliente::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email,
            'domicilio' => $this->domicilio,
            'tel_movil' => $this->tel_movil,
            'profesion' => $this->profesion,
        ]);

        $this->creatingCliente = false;
        $this->reset(['nombres', 'apellidos', 'email', 'domicilio', 'tel_movil', 'profesion']);
        $this->emit('alert', 'El cliente fue agregado correctamente!');
        $this->emit('render');
    }

    public $clienteIdToEdit;

    public $clienteModalOpen = false;

    public $editNombres, $editApellidos, $editEmail, $editDomicilio, $editTel_movil, $editProfesion;

    public function abrirModalEdicion($clienteId)
    {
        $this->clienteIdToEdit = $clienteId;
        $cliente = Cliente::find($clienteId);

        // Asignar los datos del cliente a las propiedades para la edición
        $this->editNombres = $cliente->nombres;
        $this->editApellidos = $cliente->apellidos;
        $this->editEmail = $cliente->email;
        $this->editDomicilio = $cliente->domicilio;
        $this->editTel_movil = $cliente->tel_movil;
        $this->editProfesion = $cliente->profesion;

        // Emitir evento para abrir el modal
        $this->clienteModalOpen = true;
    }


    public $updatingCliente;

    public function actualizarCliente()
    {
        $this->updatingCliente = true;

        $this->validate(
            [
                'editNombres' => 'required',
                'editApellidos' => 'required',
                'editEmail' => 'required'
            ],
            [
                'editNombres.required' => 'Debe ingresar un Nombre.',
                'editApellidos.required' => 'Debe ingresar un Apellido.',
                'editEmail.required' => 'Debe ingresar un email.'
            ]
        );

        $cliente = Cliente::find($this->clienteIdToEdit);
        $cliente->update([
            'nombres' => $this->editNombres,
            'apellidos' => $this->editApellidos,
            'email' => $this->editEmail,
            'domicilio' => $this->editDomicilio,
            'tel_movil' => $this->editTel_movil,
            'profesion' => $this->editProfesion,
        ]);

        $this->dispatchBrowserEvent('cerrarModalEdicion');

        $this->updatingCliente = false;
        $this->reset(['editNombres', 'editApellidos', 'editEmail', 'editDomicilio', 'editTel_movil', 'editProfesion']);

        $this->clienteModalOpen = false;
        $this->emit('render');
        $this->emit('alert', 'Cliente actualizado correctamente!');
    }

    // Borrar siniestro
    public $delete_id;

    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteCliente(){
        $cliente = Cliente::where('id', $this->delete_id)->first();
        $cliente->update(['activo' => 0]);

        $this->dispatchBrowserEvent('clienteBorrado');
        $this->emit('render');
        $this->emit('alert','Cliente borrado correctamente!');
    }

    function clientesProyectos($clienteId)
    {
        return redirect()->to('/cliente/proyectos/' . $clienteId);
    }
}
