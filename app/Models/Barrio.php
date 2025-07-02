<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    //
    protected $table = 'barrios';

    protected $fillable = [
        'nombre',
        'municipio_id',
        'corregimiento_id',
        'altitud',
        'longitud'
    ];

    public $timestamps = false;

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

    public function corregimiento()
    {
        return $this->belongsTo(Corregimiento::class, 'corregimiento_id', 'id');
    }

    public function puestos()
    {
        return $this->hasMany(Puesto::class, 'barrio_id', 'id');
    }

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'barrio_id', 'id');
    }
}
