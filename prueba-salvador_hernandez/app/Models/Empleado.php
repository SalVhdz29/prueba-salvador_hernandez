<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory;

    public function id_municipio(){
        return $this->hasOne(Catalogo::class, 'foreign_key');
    }
    public function id_departamento(){
        return $this->hasOne(Catalogo::class, 'foreign_key');
    }
}
