<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votante extends Model
{
    protected $table = 'votantes';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'municipio_id',
        'corregimiento_id',
        'barrio_id',
        'puesto_id',
        'mesa_id',
        'compromiso_id',
        'recomendacion'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

    public function corregimiento()
    {
        return $this->belongsTo(Corregimiento::class, 'corregimiento_id', 'id');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id', 'id');
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id', 'id');
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class, 'mesa_id', 'id');
    }

    public function compromiso()
    {
        return $this->belongsTo(Compromiso::class, 'compromiso_id', 'id');
    }    
}
