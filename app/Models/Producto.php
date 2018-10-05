<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'productos';

    //Relacion 300818_0224. 1:M. Lado M
    public function SubCategoriaProducto(){
        return $this->belongsTo(ClasificacionProducto::class,'subcategoria_id', 'id');
    }

    //Relacion 300818_0224. 1:M. Lado M
    public function Clasificacion1Producto(){
        return $this->belongsTo(ClasificacionProducto::class,'clasificacion1_id', 'id');
    }
    
}
