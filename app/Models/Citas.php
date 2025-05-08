<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_citas';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_vehiculos',
        'fecha_cita',
        'hora_cita',
        'estado',
        'detalles_vehiculo'
    ];

    protected $casts = [
        'fecha_cita' => 'date',
        'hora_cita' => 'datetime:H:i'
    ];

    // Relación con Vehiculo
    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculos::class, 'id_vehiculos');
    }
}