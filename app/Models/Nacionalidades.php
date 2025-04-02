<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidades extends Model
{
    public function compras(){

        return $this->hasMany(Compras::class);
    }
}
