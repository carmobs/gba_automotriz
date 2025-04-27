<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puestos extends Model
{
    use HasFactory;

    protected $table = 'puestos';
    protected $primaryKey = 'id_puestos'; // Cambiado de 'id_puesto' a 'id_puestos'
    public $incrementing = false;
    protected $keyType = 'int';
    protected $nombre_puesto;
    protected $descripcion;
    protected $sueldo;
    protected $fillable = ['nombre_puesto', 'descripcion','sueldo'];
    public $timestamps = false;
}
