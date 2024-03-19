<?php

namespace App\Http\Livewire\Producto;

use App\Models\Producto;
use Livewire\Component;

class IndexProducto extends Component
{
    public function render()
    {
        $productos = Producto::paginate(10);
        $productosCount = Producto::all()->count();

        return view('livewire.producto.index-producto', compact('productos', 'productosCount'));
    }

    public $codigo, $descripcion, $imagen;

    public $creatingProducto, $modalOpen = false;

    public function crearProducto()
    {
        $this->creatingProducto = true;

        $this->validate(
            [
                'codigo' => 'required|max:30|unique',
                'descripcion' => 'required|max:100'
            ],
            [
                'codigo.required' => 'Debe ingresar un Código.',
                'codigo.max:30' => 'El código debe ser menor a 30 caracteres.',
                'codigo.unique' => 'Ese código ya existe',
                'descripcion.required' => 'Debe ingresar una descripción.',
            ]
        );

        Producto::create([
            'codigo' => $this->codigo,
            'descripcion' => $this->descripcion,
            'imagen' => $this->imagen
        ]);

        $this->creatingProducto = false;
        $this->reset(['codigo', 'descripcion', 'imagen']);
        $this->emit('alert', 'El producto fue agregado correctamente!');
        $this->emit('render');
    }
}
