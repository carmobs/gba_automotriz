<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparacion';
    protected $primaryKey = 'id_reparacion';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_empleados;
    protected $id_vehiculos;
    protected $fecha_reparacion;
    protected $estado;
    protected $fillable = [
        'id_empleados',
        'id_vehiculos',
        'fecha_reparacion',
        'estado',
        'id_citas'
    ];
    public $timestamps = false;

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'id_vehiculos', 'id_vehiculos');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleados::class, 'id_empleados');
    }

    public function cita()
    {
        return $this->belongsTo(Citas::class, 'id_citas');
    }
}
