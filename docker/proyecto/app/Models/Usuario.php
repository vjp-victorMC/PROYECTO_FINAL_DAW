<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'email',
        'dni',
        'telefono', // Añadido
        'contraseña',
        'rol',
    ];

    protected $hidden = [
        'contraseña',
    ];

    public $timestamps = false;

    /**
     * Laravel expects a password field; usamos 'contraseña' en la tabla,
     * así que indicamos a Auth cuál es el campo de la contraseña.
     */
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function coches()
    {
        return $this->hasMany(Coche::class, 'id_usuario');
    }
}
