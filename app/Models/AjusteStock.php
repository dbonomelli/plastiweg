<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjusteStock extends Model
{
    use HasFactory;
    protected $table = "ajuste_stock";
    protected $primaryKey = 'id_ajuste';
    public $timestamps = false;
}
