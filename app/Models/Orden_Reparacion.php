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
    protected $fillable = ['id_reparacion', 'id_servicios', 'costo_unitario_servicio', 'cantidad', 'estado'];
    public $timestamps = false;

    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->costo_unitario_servicio * $this->cantidad;
    }
}
