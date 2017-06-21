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
            $view->with('empresa_direccion', $empresa->empresa_direccion);
            $view->with('empresa_numexterior',$empresa->empresa_numexterior);
            $view->with('empresa_numinterior', $empresa->empresa_numinterior);
            $view->with('empresa_referencia', $empresa->empresa_referencia);
            $view->with('empresa_colonia', $empresa->empresa_colonia);
            $view->with('empresa_codigopostal',$empresa->empresa_codigopostal);
            $view->with('empresa_delegacion', $empresa->empresa_delegacion);
            $view->with('empresa_localidad', $empresa->empresa_localidad);
            $view->with('empresa_estado', $empresa->empresa_estado);
            $view->with('empresa_pais', $empresa->empresa_pais);
        }

    }

}



