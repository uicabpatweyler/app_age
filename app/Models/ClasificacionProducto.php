<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClasificacionProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clasificaciones_productos';
    
    //Relacion 300818_0224. 1:M. Lado 1
    public function Productos(){
        return $this->hasMany(Producto::class);
    }
}
