<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoTaller extends Model
{
    use HasFactory;

    protected $table = 'saldo_taller';

    // Desactivamos el auto-incremento porque el ID siempre será fijo (1)
    public $incrementing = false;

    // Desactivamos los timestamps estándar de Laravel ya que manejas tu propia columna
    public $timestamps = false;

    protected $fillable = [
        'id',
        'saldo',
    ];
}
