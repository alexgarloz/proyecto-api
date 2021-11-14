<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'apellido1',
        'apellido2',
        'descripcion',
        'idioma',
        'habilidades',
        'estado',
        'email',
        'img_perfil',
        'password',
        'rol'
    ];
}
