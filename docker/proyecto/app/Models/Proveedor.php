<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
    ];

    // Relación inversa: Un proveedor tiene muchas piezas
    public function piezas()
    {
        return $this->hasMany(Pieza::class, 'id_proveedor', 'id_proveedor');
    }
}
