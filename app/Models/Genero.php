<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    //
    protected $table = 'generos';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'genero_id', 'id');
    }
}
