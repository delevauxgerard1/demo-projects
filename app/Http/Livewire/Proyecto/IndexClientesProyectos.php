<?php

namespace App\Http\Livewire\Proyecto;

use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Tarea;
use Livewire\Component;

class IndexClientesProyectos extends Component
{
    public $clienteid;
    public $proyectos;
    public $proyectoSeleccionado;
    public $proyectoSeleccionadoId;
    public $tareas;
    public $cliente;

    protected $listeners = ['render', 'tareaActualizada' => 'renderTareas', 'deleteConfirmed' => 'deleteTarea'];

    public function renderTareas()
    {
        $this->cargarTareas($this->proyectoSeleccionado->id);
    }


    public function mount($clienteid, $proyectoid = null)
    {
        $this->clienteid = $clienteid;
        $this->cliente = Cliente::where('id', $this->clienteid)->first();
        $this->proyectos = Proyecto::where('cliente_id', $this->clienteid)->get();

        if ($proyectoid !== null) {
            $this->proyectoSeleccionado = Proyecto::find($proyectoid);
        } else {
            $this->proyectoSeleccionado = $this->proyectos->first();
        }

        if ($this->proyectoSeleccionado) {
            $this->cargarTareas($this->proyectoSeleccionado->id);
        }
    }

    public function render()
    {
        return view('livewire.proyecto.index-clientes-proyectos', [
            'proyectos' => $this->proyectos,
            'tareas' => $this->tareas,
            'cliente' => $this->cliente,
        ]);
    }

    public function seleccionarProyecto($proyectoId)
    {
        $this->proyectoSeleccionado = Proyecto::find($proyectoId);
        $this->cargarTareas($proyectoId);
    }

    private function cargarTareas($proyectoId)
    {
        $this->tareas = Tarea::where('proyecto_id', $proyectoId)
            ->where('activo', 1)
            ->get();
    }

    public function toggleCompletada($tareaId)
    {
        $tarea = Tarea::find($tareaId);
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        $this->emit('tareaActualizada');
    }

    public function calcularPorcentajeTareasFinalizadas($proyectoId)
    {
        $totalTareas = Tarea::where('proyecto_id', $proyectoId)
            ->where('activo', 1)
            ->count();

        $tareasFinalizadas = Tarea::where('proyecto_id', $proyectoId)
            ->where('completada', true)
            ->where('activo', 1)
            ->count();

        return ($totalTareas > 0) ? round(($tareasFinalizadas / $totalTareas) * 100) : 0;
    }

    public $nombre, $fecha_limite, $descripcion;

    public $creatingCliente, $modalOpen = false;

    public function crearTarea()
    {
        $this->validate(
            [
                'nombre' => 'required',
            ],
            [
                'nombre.required' => 'Debe ingresar un Nombre.',
            ]
        );

        Tarea::create([
            'proyecto_id' => $this->proyectoSeleccionado->id,
            'nombre' => $this->nombre,
            'fecha_limite' => $this->fecha_limite,
            'descripcion' => $this->descripcion
        ]);

        $this->cargarTareas($this->proyectoSeleccionado->id);

        $this->creatingCliente = false;
        $this->reset(['nombre', 'fecha_limite', 'descripcion']);
        $this->emit('alert', 'La tarea fue agregada correctamente!');
    }

    public $tareaidtoedit;

    public $editModalOpen = false;

    public $editnombre, $editfechalimite, $editdescripcion;

    public function abrirModalEdicion($tareaid)
    {
        $this->tareaidtoedit = $tareaid;
        $tarea = Tarea::find($tareaid);

        $this->editnombre = $tarea->nombre;
        $this->editdescripcion = $tarea->descripcion;
        $this->editfechalimite = $tarea->fecha_limite;
        $this->editModalOpen = true;
    }

    public $updatingTarea;

    public function actualizarTarea()
    {
        $this->updatingTarea = true;

        $this->validate(
            [
                'editnombre' => 'required',
            ],
            [
                'editnombre.required' => 'Debe ingresar un Nombre.',
            ]
        );

        $tarea = Tarea::find($this->tareaidtoedit);
        $tarea->update([
            'proyecto_id' => $this->proyectoSeleccionado->id,
            'nombre' => $this->editnombre,
            'fecha_limite' => $this->editfechalimite,
            'descripcion' => $this->editdescripcion
        ]);

        $this->dispatchBrowserEvent('cerrarModalEdicion');

        $this->updatingTarea = false;
        $this->reset(['editnombre', 'editfechalimite', 'editdescripcion']);

        $this->editModalOpen = false;
        $this->emit('render');
        $this->emit('alert', 'Tarea actualizada correctamente!');
    }

    public $delete_id;

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteTarea()
    {
        $tarea = Tarea::where('id', $this->delete_id)->first();
        $tarea->update(['activo' => 0]);

        $this->dispatchBrowserEvent('tareaBorrada');
        $this->emit('render');
        $this->emit('alert', 'Tarea borrada correctamente!');

        $this->renderTareas();
    }
}
