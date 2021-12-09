<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoServicio extends Model
{
    use HasFactory;

    protected $table = 'contrato_servicio';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'precio',
        'imagen',
        'id_servicio',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }

    public function servicio()
    {
        return $this->hasOne(Servicio::class, 'id', 'id_servicio');
    }
}
