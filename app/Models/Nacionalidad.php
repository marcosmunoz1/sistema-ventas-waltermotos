<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Nacionalidad extends Model
{
    protected $table = 'nacionalidades';

    public function motos()
    {
        return $this->hasMany(Moto::class, 'id_nacionalidad');
    }

    public function compras(){

        return $this->hasMany(Compra::class);
    }

}
