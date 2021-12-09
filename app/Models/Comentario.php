<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentario';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'texto',
        'id_servicio',
        'id_usuario'
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id', 'id_servicio');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id', 'id_usuario');
    }
}
