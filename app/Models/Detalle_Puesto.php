<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detalle_Puesto extends Model
{
    use HasFactory;

    protected $table = 'detalle_puesto';
    protected $primaryKey = 'id_detalle_puesto';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_empleados;
    protected $id_puestos;
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $fillable = ['id_empleados','id_puestos','fecha_inicio','fecha_fin'];
    public $timestamps = false;
}
