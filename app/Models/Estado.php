<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = "estados";

    protected $fillable = [
        'nombre'
    ];

    public function proyecto()
    {
        return $this->hasOne(Proyecto::class, 'estado_id');
    }
}
