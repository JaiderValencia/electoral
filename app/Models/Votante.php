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
        'corregimiento_id',
        'barrio_id',        
        'mesa_id',
        'compromiso_id',
        'recomendacion'
    ];
    
    public function corregimiento()
    {
        return $this->belongsTo(Corregimiento::class, 'corregimiento_id', 'id');
    }

    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id', 'id');
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
