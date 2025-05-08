<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'servicios';
    protected $primaryKey = 'id_servicios';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'tiempo',
        'costo',
        'estado'
    ];

    public function ordenesReparacion()
    {
        return $this->hasMany(Orden_Reparacion::class, 'id_servicios');
    }
}
