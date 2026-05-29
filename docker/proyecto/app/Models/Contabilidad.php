<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Contabilidad extends Model
{
    use HasFactory;

    protected $table = 'contabilidad';
    protected $primaryKey = 'id_transaccion';

    protected $fillable = [
        'tipo',
        'cantidad',
        'fecha',
        'concepto',
        'id_usuario',
    ];

    // Relación con el usuario que generó el movimiento
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    /**
     * El método boot se ejecuta automáticamente.
     * Escuchamos el evento 'created' para actualizar el saldo del taller.
     */
    protected static function booted()
    {
        static::created(function ($transaccion) {
            // Buscamos el registro único de saldo (ID 1) o lo creamos si no existe
            $saldoTaller = SaldoTaller::firstOrCreate(['id' => 1]);

            if ($transaccion->tipo === 'ingreso') {
                $saldoTaller->saldo += $transaccion->cantidad;
            } elseif ($transaccion->tipo === 'gasto') {
                $saldoTaller->saldo -= $transaccion->cantidad;
            }

            $saldoTaller->save();
        });
    }

}
