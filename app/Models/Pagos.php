<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pagos extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $primaryKey = 'id_pagos';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $id_reparacion;
    protected $fecha;
    protected $monto;
    protected $fillable = ['id_pagos', 'id_reparacion', 'fecha', 'monto'];
    public $timestamps = false;
}
