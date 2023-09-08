<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCliente extends Component
{
    use WithPagination;

    public $paginas = 20;
    public $sort = 'nombres';
    public $direction = 'asc';

    public function render()
    {
        $clientes = Cliente::where("activo", "=", "1")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->paginas);

        return view('livewire.cliente.index-cliente', compact('clientes'));
    }

    public $nombres, $apellidos, $email;

    public function crearCliente()
    {        
        Cliente::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'email' => $this->email
        ]);

        $this->reset(['nombres', 'apellidos', 'email']);
    }
}
