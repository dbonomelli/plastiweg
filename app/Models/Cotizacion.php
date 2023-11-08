<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    protected $table = "cotizacion";
    public $timestamps = false;

    protected $primaryKey = 'num_cotizacion';
    protected $KeyType="string";

    public function detalles(){
        return $this->hasMany('App\Detalle');
    }
}
