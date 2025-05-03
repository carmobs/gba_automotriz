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

    // Relación con servicios
    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'id_servicios');
    }

    // Relación con reparaciones
    public function reparacion()
    {
        return $this->belongsTo(Reparacion::class, 'id_reparacion');
    }

    // Atributo calculado para el total
    public function getTotalAttribute()
    {
        $total = $this->costo_unitario_servicio * $this->cantidad;
        \Log::info("Calculating total: {$total} for Orden_Reparacion ID: {$this->id_detalle_reparacion}");
        return $total;
    }
}
