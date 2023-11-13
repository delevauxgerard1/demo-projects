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

    protected $listeners = ['render','deleteConfirmed'=>'deleteCliente'];

    public function render()
    {
        $proyectos = Proyecto::where("activo", "=", "1")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginas);

        $proyectosCount = Proyecto::where("activo", "=", "1")->count();
        $clientes = Cliente::all();
        $usuarios = User::all();

        return view('livewire.index-proyectos', compact('proyectos', 'proyectosCount', 'clientes', 'usuarios'));
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
    
}
