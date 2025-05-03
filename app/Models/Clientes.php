<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id_clientes';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['nombre', 'telefono'];
    public $timestamps = false;

    // Relación con vehículos
    public function vehiculos(): HasMany
    {
        return $this->hasMany(Vehiculos::class, 'id_clientes', 'id_clientes');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($cliente) {
            // Eliminar todos los vehículos asociados al cliente
            foreach ($cliente->vehiculos as $vehiculo) {
                $vehiculo->delete(); // Esto también eliminará las citas asociadas
            }
        });
    }
}
