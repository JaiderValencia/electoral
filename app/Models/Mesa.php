<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $table = 'mesas';

    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'puesto_id',
    ];

    public function puesto()
    {
        return $this->belongsTo(Puesto::class, 'puesto_id', 'id');
    }

    public function votantes()
    {
        return $this->hasMany(Votante::class, 'mesa_id', 'id');
    }
}
