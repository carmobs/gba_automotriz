<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orden_Reparacion extends Model
{
    use HasFactory;

    protected $table = 'orden_reparacion';
    protected $primaryKey = 'id_detalle_reparacion';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_reparacion;
    protected $id_servicios;
    protected $costo_unitario_servicio;
    protected $cantidad;
    protected $estado;
    protected $fillable = ['id_reparacion', 'id_servicios', 'costo_unitario_servicio', 'cantidad', 'estado'];
    public $timestamps = false;
}
