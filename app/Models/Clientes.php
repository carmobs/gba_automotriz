<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_clientes';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'telefono',
        'estado'
    ];

    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class, 'id_clientes');
    }
}
