<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculos extends Model
{
    use HasFactory;
    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculos';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_clientes;
    protected $marca;
    protected $modelo;
    protected $año;
    protected $detalles_vehiculo;
    protected $fillable = ['id_clientes', 'marca', 'modelo', 'año', 'detalles_vehiculo'];
    public $timestamps = false;
}
