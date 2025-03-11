<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $nombre;
    protected $fecha_ingreso;
    protected $estado;
    protected $fillable = ['id_empleado', 'nombre', 'fecha_ingreso', 'estado'];
    public $timestamps = false;
}
