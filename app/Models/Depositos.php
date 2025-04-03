<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depositos extends Model
{
    public function compras(){

        return $this->hasMany(Compras::class);
    }
}
