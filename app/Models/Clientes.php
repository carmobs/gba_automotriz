<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clientes extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id_clientes';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $nombre;
    protected $telefono;
    protected $fillable = ['nombre', 'telefono'];
    public $timestamps = false;
}
