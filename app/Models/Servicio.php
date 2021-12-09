<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $table = 'servicio';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'id_sub_categoria',
        'id_usuario'
    ];

    public function subCategoria()
    {
        return $this->hasMany(SubCategoria::class, 'id', 'id_sub_categoria');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }

    public function imagen()
    {
        return $this->hasOne(ImgServicio::class, 'id_servicio', 'imagen');
    }
}
