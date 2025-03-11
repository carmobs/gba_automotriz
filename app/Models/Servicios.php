<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Servicios extends Model
{
    use HasFactory;
    protected $table = 'servicios';
    protected $primaryKey = 'id_servicios';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $nombre;
    protected $descripcion;
    protected $tiempo;
    protected $costo;
    protected $fillable = ['id_servicios', 'nombre', 'descripcion', 'tiempo', 'costo'];
    public $timestamps = false;
}
