<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    public function motos()
    {
        return $this->hasMany(Moto::class, 'id_deposito');
    }
}
