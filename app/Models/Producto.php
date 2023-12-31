<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "producto";
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    public function imagen(){
        return $this->hasOne(ImagenProducto::class);
    }
}
