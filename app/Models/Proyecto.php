<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = "proyectos";

    protected $fillable = [
        'nombre',
        'descripcion',
        'cliente_id',
        'fecha_inicio',
        'fecha_fin',
        'estado_id',
        'responsable_id',
        'activo'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'proyecto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
