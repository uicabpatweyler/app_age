<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CicloEscolarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function listaCiclosAjax(){
        return $ciclos = Ciclo::select('id','ciclo_anioinicial as anio1','ciclo_aniofinal as anio2')
                ->where('ciclo_activo',0)
                ->orderBy('ciclo_anioinicial', 'desc')
                ->get();
    }

    public function cambiarCicloPredeterminado(){

        $now = Carbon::now('America/Mexico_City Time Zone');

        //Obtenemos el nuevo ciclo predeterminado
        $ciclo_predeterminado = request()->get('selectCiclosEscolares');

        //Establecemos el campo 'ciclo_actual' a FALSE de todos los registros de la tabla CICLOS
        DB::table('ciclos')->update(['ciclo_actual' => false]);

        //En base al 'id' seleccionado, encontramos el ciclo que el usuario eligio
        $ciclo = Ciclo::findOrFail($ciclo_predeterminado);

        //Lo establecemos como predeterminado
        $ciclo->ciclo_actual = true;
        $ciclo->updated_at = $now;

        //Guardamos los cambios
        $ciclo->save();

        //Redirigimos de nuevo a la lista de ciclos escolares creados
        return redirect()->to('ciclos');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclos = Ciclo::where('ciclo_activo',0)
                         ->orderBy('ciclo_anioinicial','desc')
                         ->get();
        return view('cicloescolar.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('cicloescolar/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =Validator::make($request->all(),[
            'ciclo_anioinicial' => 'required|max:4',
            'ciclo_aniofinal'   => 'required|max:4',
        ]);

        if($validation->passes()){

            $test = Ciclo::where('ciclo_anioinicial',$request->get('ciclo_anioinicial'))
                    ->where('ciclo_aniofinal',$request->get('ciclo_aniofinal'))
                    ->first();

            if($test!=null){
                return response()->json([
                    'success'   => false,
                    'integridad' => true,
                    'message'   => "El ciclo escolar que trata de crear ya existe."
                ], 422);
            }


            $now = Carbon::now('America/Mexico_City Time Zone');
            $ciclo_escolar = new Ciclo();
            $ciclo_escolar->ciclo_anioinicial = $request->get('ciclo_anioinicial');
            $ciclo_escolar->ciclo_aniofinal = $request->get('ciclo_aniofinal');
            $ciclo_escolar->ciclo_actual = false;
            $ciclo_escolar->ciclo_activo = false;
            $ciclo_escolar->created_at = $now;
            $ciclo_escolar->updated_at = $now;

            $ciclo_escolar->save();

            return response()->json([
                'success' => true,
                'message' => 'El ciclo escolar se ha creado correctamente.'
            ], 200);
        }

        $errors = $validation->errors();
        $errors =  json_decode($errors);

        return response()->json([
            'success' => false,
            'message' => $errors
        ], 422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciclo = Ciclo::findOrFail($id);
        return view('cicloescolar.details', compact('ciclo'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation =Validator::make($request->all(),[
            'ciclo_anioinicial' => 'required|max:4',
            'ciclo_aniofinal'   => 'required|max:4',
        ]);

        if($validation->passes()){

            $now = Carbon::now('America/Mexico_City Time Zone');
            $ciclo_escolar = Ciclo::findOrFail($id);
            $ciclo_escolar->ciclo_anioinicial = $request->get('ciclo_anioinicial');
            $ciclo_escolar->ciclo_aniofinal = $request->get('ciclo_aniofinal');
            $ciclo_escolar->updated_at = $now;

            $ciclo_escolar->save();

            //Redirigimos de nuevo a la lista de ciclos escolares creados
            return redirect()->to('ciclos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html#error_er_row_is_referenced_2
        try{
            $ciclo = Ciclo::find($id);
            $ciclo->delete();

            return response()->json([
                'success' => true,
                'message' => 'El ciclo escolar se ha eliminado correctamente'
            ], 200);

        }catch (Exception $e){
            //Error: 1451. SQLSTATE: 2300
            //Cannot delete or update a parent row: a foreign key constraint fails
            $error_server  = $e->errorInfo[0];
            $error_code    = $e->errorInfo[1];
            $error_message = $e->errorInfo[2];

            //return dd($e);

            if($error_server == 23000 and $error_code == 1451)
            {
                return response()->json([
                    'success'      => false,
                    'error_server' => $error_server,
                    'error_code'   => $error_code,
                    'error_message_admin' => $error_message,
                    'error_message_user' => 'No es posible eliminar el ciclo escolar. Restricción de llave foránea.'
                ],422);
            }
        }
    }
}
