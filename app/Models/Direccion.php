<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'codigo_postal',
        'pais',
        'provincia',
        'domicilio',
        'ciudad',
        'id_usuario'
    ];

    public function direccion()
    {
        return $this->hasOne(User::class, 'id_usuario', 'id');
    }
}
