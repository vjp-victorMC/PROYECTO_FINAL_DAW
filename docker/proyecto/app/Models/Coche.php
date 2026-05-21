<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coche extends Model
{
    use HasFactory;

    protected $table = 'coches';
    protected $primaryKey = 'id_coche';

    protected $fillable = [
        'matricula',
        'marca',
        'modelo',
        'km',
        'combustible',
        'transmision',
        'anio_matriculacion',
        'id_usuario',
        'imagen',
        'en_garaje'
    ];

    // Relación con el usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
