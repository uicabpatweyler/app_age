<?php
//https://styde.net/uso-de-view-composer-laravel-5/
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Empresa;

class DatosEmpresaComposer{

    public function compose(View $view){
        $empresa = Empresa::all();
        if($empresa->count()===0){
            $view->with('razon_social', '{Nombre de la empresa}');
        }
        else{
            $empresa = Empresa::first();
            $view->with('razon_social', $empresa->empresa_razonsocial);
        }

    }

}



