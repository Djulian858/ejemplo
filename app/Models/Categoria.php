<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class Categoria extends Model
{
    //
    use HasFactory;

    protected $fillable = ["nombre", "descripcion", "estatus"];


    //relacion con producto
    public function producto(){
        return $this->hasMany(Producto::class,"id_categoria");
        
    }
}
