<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparacion';
    protected $primaryKey = 'id_reparacion';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $id_empleaodos;
    protected $id_clientes;
    protected $fecha_reparacion;
    protected $estado;
    protected $fillable = ['id_empleado', 'id_cliente', 'fecha_reparacion', 'estado'];
    public $timestamps = false;
}
