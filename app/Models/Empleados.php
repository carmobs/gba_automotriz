<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleados'; // Corrected primary key
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['id_empleados', 'nombre', 'fecha_ingreso', 'estado']; // Corrected field name
    public $timestamps = false;

    public function detalle_Puestos()
    {
        return $this->hasMany(Detalle_Puesto::class, 'id_empleados', 'id_empleados');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($empleado) {
            $empleado->detalle_Puestos()->delete();
        });
    }
}
