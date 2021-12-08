<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
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
        'id_tipo'
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo', 'id');
    }

    public function subCategoria()
    {
        return $this->hasMany(Sub_Categoria::class, 'id_categoria', 'id');
    }
}
