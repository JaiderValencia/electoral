<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'barrio_id',
        'direccion',
    ];

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id', 'id');
    }

    public function mesas()
    {
        return $this->hasMany(Mesa::class, 'puesto_id', 'id');
    }

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'puesto_id', 'id');
    }
}
