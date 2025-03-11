<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_citas';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_vehiculos;
    protected $fecha_cita;
    protected $hora_cita;
    protected $estado;
    protected $fillable = ['id_vehiculos', 'fecha_cita', 'hora_cita', 'estado'];
    public $timestamps = false;
}