<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'reparaciones';

    // Clave primaria personalizada
    protected $primaryKey = 'id_reparacion';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'id_coche',
        'id_mecanico',
        'motivo',
        'horas_trabajo',
        'coste_mano_obra',
        'coste_total_piezas',
        'coste_total_reparacion',
        'fecha_entrada',
        'fecha_salida',
        'estado'
    ];

    // Relación con el Coche
    public function coche()
    {
        return $this->belongsTo(Coche::class, 'id_coche', 'id_coche');
    }

    // Relación con el Mecánico (Usuario)
    public function mecanico()
    {
        return $this->belongsTo(Usuario::class, 'id_mecanico', 'id_usuario');
    }
}
