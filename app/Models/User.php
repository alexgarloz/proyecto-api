<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function contratosServicio()
    {
        return $this->hasMany(Contrato_Servicio::class, 'id_usuario', 'id');
    }

    public function servicios()
    {
        return $this->hasMany(Servicio::class, 'id_usuario', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_usuario', 'id');
    }

    public function direccion()
    {
        return $this->hasOne(Direccion::class, 'id_usuario', 'id');
    }
}
