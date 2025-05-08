<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puestos extends Model
{
    use HasFactory;

    protected $table = 'puestos'; // Nombre correcto de la tabla
    protected $primaryKey = 'id_puestos'; // Clave primaria correcta
    public $incrementing = true; // Cambiado a true porque normalmente las claves primarias son autoincrementales
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = ['id_puestos', 'nombre_puesto', 'descripcion', 'sueldo', 'estado']; // Added 'estado'
    public $timestamps = false; // Desactiva timestamps si no existen en la tabla
}
