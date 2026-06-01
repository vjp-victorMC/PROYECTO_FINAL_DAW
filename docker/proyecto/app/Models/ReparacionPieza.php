<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReparacionPieza extends Model
{
    use HasFactory;

    protected $table = 'reparaciones_piezas';

    protected $fillable = [
        'id_reparacion',
        'id_pieza',
        'cantidad_usada',
        'id_usuario'
    ];

    // Desactivar timestamps si tu tabla no tiene created_at y updated_at
    public $timestamps = false;

    // Relación con la Reparación
    public function reparacion()
    {
        return $this->belongsTo(Reparacion::class, 'id_reparacion', 'id_reparacion');
    }

    // Relación con la Pieza (Asegúrate de que el modelo Pieza tenga 'id_pieza' o 'id')
    public function pieza()
    {
        return $this->belongsTo(Pieza::class, 'id_pieza', 'id_pieza');
    }

    // Relación con el Usuario/Mecánico que la usó
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
