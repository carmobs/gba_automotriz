<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparacion';
    protected $primaryKey = 'id_reparacion';
    protected $fillable = [
        'id_vehiculos',
        'id_empleados',
        'fecha_reparacion',
        'estado',
        'id_citas'
    ];
    public $timestamps = false;

    // Relación con órdenes de reparación
    public function ordenes()
    {
        return $this->hasMany(Orden_Reparacion::class, 'id_reparacion');
    }

    // Relación con vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculos::class, 'id_vehiculos');
    }
}
