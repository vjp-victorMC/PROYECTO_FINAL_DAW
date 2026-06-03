<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche2Mano extends Model
{
    use HasFactory;

    protected $table = 'vehiculo2mano';

    protected $fillable = [
        'matricula',
        'marca',
        'modelo',
        'imagen',
        'precio',
        'anio_matriculacion',
        'motorizacion',
        'especificaciones',
        'km'
    ];
}
