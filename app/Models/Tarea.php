<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = "tareas";

    protected $fillable = [
        'proyecto_id',
        'nombre', 
        'descripcion',
        'fecha_limite',
        'completada'
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}
