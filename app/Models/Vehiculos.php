<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehiculos extends Model
{
    use HasFactory;

    protected $table = 'vehiculos'; // Nombre correcto de la tabla
    protected $primaryKey = 'id_vehiculos'; // Clave primaria correcta
    public $incrementing = true; // La clave primaria es autoincremental
    protected $keyType = 'int'; // Tipo de clave primaria

    protected $fillable = [
        'id_clientes',
        'marca',
        'modelo',
        'año',
        'estado'
    ]; // Campos asignables
    public $timestamps = false; // Desactiva timestamps si no existen en la tabla

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Clientes::class, 'id_clientes');
    }

    public function reparaciones(): HasMany
    {
        return $this->hasMany(Reparacion::class, 'id_vehiculos');
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Citas::class, 'id_vehiculos', 'id_vehiculos');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($vehiculo) {
            $vehiculo->citas()->delete();
        });
    }
}
