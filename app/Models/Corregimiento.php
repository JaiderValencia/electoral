<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Corregimiento extends Model
{
    //
    protected $table = 'corregimientos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'municipio_id',
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'corregimiento_id', 'id');
    }

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'corregimiento_id', 'id');
    }
}
