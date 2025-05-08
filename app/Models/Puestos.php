<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puestos extends Model
{
    protected $table = 'puestos';
    protected $primaryKey = 'id_puestos';
    public $timestamps = false;

    protected $fillable = [
        'nombre_puesto',
        'descripcion',
        'sueldo',
        'estado'
    ];

    public function detallePuestos()
    {
        return $this->hasMany(Detalle_Puesto::class, 'id_puestos');
    }
}
