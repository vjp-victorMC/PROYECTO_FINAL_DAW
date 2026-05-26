<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';
    protected $primaryKey = 'id_mensaje';

    // Se incluye matricula en los campos permitidos
    protected $fillable = [
        'usuario_envio',
        'usuario_recibo',
        'matricula',
        'asunto',
        'mensaje',
    ];

    public function remitente(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_envio', 'id_usuario');
    }

    public function destinatario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_recibo', 'id_usuario');
    }
}
