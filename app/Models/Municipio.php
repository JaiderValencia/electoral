<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $table = 'municipios';

    protected $fillable = [
        'nombre',
        'departamento_id',
    ];

    public $timestamps = false;

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }

    public function corregimientos()
    {
        return $this->hasMany(Corregimiento::class, 'municipio_id', 'id');
    }

    public function barrios()
    {
        return $this->hasMany(Barrio::class, 'municipio_id', 'id');
    }

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'municipio_id', 'id');
    }
}
