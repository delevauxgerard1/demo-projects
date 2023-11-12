<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'nombres', 
        'apellidos',
        'domicilio',
        'provincia_id',
        'tel_movil',
        'profesion',
        'email',
        'activo'
    ];

    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'cliente_id');
    }
}
