<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model
{
    use HasFactory;

    protected $table = 'piezas';
    protected $primaryKey = 'id_pieza';

    protected $fillable = [
        'nombre_pieza',
        'cantidad_disponible',
        'precio_compra',
        'precio_venta',
        'stock_minimo',
        'id_proveedor',
    ];

    // Relación con el proveedor (opcional, por si la necesitas)
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
