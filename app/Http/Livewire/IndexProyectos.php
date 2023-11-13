<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Estado;
use App\Models\Proyecto;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class IndexProyectos extends Component
{
    use WithPagination;

    public $paginas = 15;
    public $sort = 'cliente_id';
    public $direction = 'desc';

    protected $listeners = ['render','deleteConfirmed'=>'deleteProyecto'];

    public function render()
    {
        $proyectos = Proyecto::where("activo", "=", "1")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginas);

        $proyectosCount = Proyecto::where("activo", "=", "1")->count();
        $clientes = Cliente::all();
        $usuarios = User::all();
        $estados = Estado::all();

        return view('livewire.index-proyectos', compact('proyectos', 'proyectosCount', 'clientes', 'usuarios', 'estados'));
    }

    public $nombre, $descripcion, $cliente_id, $fecha_inicio, $fecha_fin, $estado_id, $responsable_id;

    public $creatingProyecto, $modalOpen = false;

    public function crearProyecto()
    {
        $this->creatingProyecto = true;
    
        $this->validate(
            [
                'nombre' => 'required',
                'cliente_id' => 'required'
            ],
            [
                'nombre.required' => 'Debe ingresar un Nombre.',
                'cliente_id.required' => 'Debe poseer un cliente.'
            ]
        );
    
        $estado = Estado::find(1);
    
        Proyecto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'cliente_id' => $this->cliente_id,
            'fecha_inicio' => now(),
            'fecha_fin' => $this->fecha_fin,
            'estado_id' => $estado->id,
            'responsable_id' => $this->responsable_id
        ]);
    
        $this->creatingProyecto = false;
        $this->reset(['nombre', 'descripcion', 'cliente_id', 'fecha_inicio', 'fecha_fin', 'estado_id', 'responsable_id']);
        $this->emit('alert', 'El proyecto fue agregado correctamente!');
        $this->emit('render');
    }

    function clientesProyectos($proyectoId)
    {
        $proyecto = Proyecto::where('id', $proyectoId)->first();
        $cliente = Cliente::where('id', $proyecto->cliente_id)->first();
        $clienteId = $cliente->id;
        return redirect()->to('/cliente/proyectos/' . $clienteId . '/' . $proyectoId);
    }

    public $proyectoIdToEdit;

    public $proyectoModalOpen = false;

    public $editnombre, $editdescripcion, $editcliente_id, $editfecha_inicio, $editfecha_fin, $editestado_id, $editresponsable_id;

    public function abrirModalEdicion($proyectoId)
    {
        $this->proyectoIdToEdit = $proyectoId;
        $proyecto = Proyecto::find($proyectoId);
        $this->editnombre = $proyecto->nombre;
        $this->editdescripcion = $proyecto->descripcion;
        $this->editcliente_id = $proyecto->cliente_id;
        $this->editfecha_inicio = $proyecto->fecha_inicio;
        $this->editfecha_fin = $proyecto->fecha_fin;
        $this->editestado_id = $proyecto->estado_id;
        $this->editresponsable_id = $proyecto->responsable_id;

        $this->proyectoModalOpen = true;
    }

    public $updatingProyecto;

    public function actualizarProyecto()
    {
        $this->updatingProyecto = true;

        $this->validate(
            [
                'editnombre' => 'required',
                'editcliente_id' => 'required'
            ],
            [
                'editnombre.required' => 'Debe ingresar un Nombre.',
                'editcliente_id.required' => 'Debe poseer un cliente.'
            ]
        );

        $proyecto = Proyecto::find($this->proyectoIdToEdit);
        $proyecto->update([
            'nombre' => $this->editnombre,
            'descripcion' => $this->editdescripcion,
            'cliente_id' => $this->editcliente_id,
            'fecha_inicio' => $this->editfecha_inicio,
            'fecha_fin' => $this->editfecha_fin,
            'estado_id' => $this->editestado_id,
            'responsable_id' => $this->editresponsable_id,
        ]);

        $this->dispatchBrowserEvent('cerrarModalEdicion');

        $this->updatingProyecto = false;
        $this->reset(['editnombre', 'editdescripcion', 'editcliente_id', 'editfecha_inicio', 'editfecha_fin', 'editestado_id', 'editresponsable_id']);

        $this->proyectoModalOpen = false;
        $this->emit('render');
        $this->emit('alert', 'Proyecto actualizado correctamente!');
    }

    public $delete_id;

    public function deleteConfirmation($id){
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteProyecto(){
        $proyecto = Proyecto::where('id', $this->delete_id)->first();
        $proyecto->update(['activo' => 0]);

        $this->dispatchBrowserEvent('proyectoBorrado');
        $this->emit('render');
        $this->emit('alert','Proyecto borrado correctamente!');
    }
}
