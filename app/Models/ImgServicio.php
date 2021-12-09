<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgServicio extends Model
{
    use HasFactory;

    protected $table = 'img_servicio';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'imagen',
        'id_servicio'
    ];

    public function servicio()
    {
        return $this->hasOne(Servicio::class, 'id_servicio', 'imagen');
    }
}
