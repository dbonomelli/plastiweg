<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendedor extends Authenticable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = "vendedor";
    protected $primaryKey = 'id_vendedor';
    public $timestamps = false;
    protected $keyType = "string";
}
