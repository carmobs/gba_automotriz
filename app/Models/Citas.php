<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas'; // Nombre correcto de la tabla
    protected $primaryKey = 'id_citas'; // Clave primaria correcta
    public $incrementing = true; // La clave primaria es autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = ['id_vehiculos', 'fecha_cita', 'hora_cita', 'estado']; // Campos que se pueden asignar masivamente
    public $timestamps = false; // Desactiva timestamps si no existen en la tabla
}