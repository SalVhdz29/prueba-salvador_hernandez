<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index(){
        //obteniendo data
        $departamentos = Catalogo::where('id_padre',null)->get();
        $empleados = DB::table('empleados')
                    ->leftJoin('catalogos AS catalogoMuni','empleados.id_municipio','=','catalogoMuni.id')
                    ->leftJoin('catalogos AS catalogoDepa','catalogoMuni.id_padre','=','catalogoDepa.id')
                    ->select('empleados.*','catalogoMuni.valor AS municipio', 'catalogoDepa.valor AS departamento')
                    ->get();



        return view('empleados',[
            'departamentos'=>$departamentos,
            'empleados'=>$empleados,
        ]);
    }
    public function indexEmpleados(){
        $empleados = DB::table('empleados')
        ->leftJoin('catalogos AS catalogoMuni','empleados.id_municipio','=','catalogoMuni.id')
        ->leftJoin('catalogos AS catalogoDepa','catalogoMuni.id_padre','=','catalogoDepa.id')
        ->select('empleados.*','catalogoMuni.valor AS municipio', 'catalogoDepa.valor AS departamento')
        ->get();

        return response()->json($empleados);
    }
    public function get($idEmpleado){
        $empleado =Empleado::findOrFail($idEmpleado);
        return response()->json($empleado);
    }
    public function insert(Request $request){
         //validando datos
         $request->validate([
            'nombres' =>'required|min:5',
            'apellidos'=>'required|min:5',
            'correo'=>'email',
            'telefono'=>'size:8',
            'id_departamento' => 'required|not_in:0',
            'id_municipio'=>'required|not_in:0'
        ]);
        $departamento = Catalogo::findOrFail($request->get('id_departamento'));
        $municipio = Catalogo::findOrFail($request->get('id_departamento'));

        $empleado = new Empleado();
        $empleado->nombre=$request->get('nombres');
        $empleado->apellido=$request->get('apellidos');
        $empleado->correo=$request->get('correo');
        $empleado->telefono=$request->get('telefono');
        $empleado->direccion = $departamento->valor." - ".$municipio->valor;
        $empleado->id_departamento=$request->get('id_departamento');
        $empleado->id_municipio=$request->get('id_municipio');

        $empleado->save();


        return response()->json([
            'message'=>'OK'
        ]);
    }
    public function update(Request $request){
        //validando datos
        $request->validate([
            'id_empleado'=>'required|not_in:0',
            'nombres' =>'required|min:5',
            'apellidos'=>'required|min:5',
            'correo'=>'email',
            'telefono'=>'size:8',
            'id_departamento' => 'required|not_in:0',
            'id_municipio'=>'required|not_in:0'
        ]);

        $empleado = Empleado::findOrFail($request->get('id_empleado'));
        $empleado->nombre=$request->get('nombres');
        $empleado->apellido=$request->get('apellidos');
        $empleado->correo=$request->get('correo');
        $empleado->telefono=$request->get('telefono');
        $empleado->id_departamento=$request->get('id_departamento');
        $empleado->id_municipio=$request->get('id_municipio');

        $empleado->save();
        return response()->json([
            'message'=>'OK'
        ]);
    }
    public function delete($idEmpleado){
        Empleado::find($idEmpleado)->delete();
        return response()->json([
            'message'=>'OK'
        ]);
    }
    public function getMunicipios($idDepartamento){
        $municipios = Catalogo::where('id_padre',$idDepartamento)->get();

        return response()->json([
            'municipios'=>$municipios
        ]);
    }
    public function obtenerEmpleadosFilter(Request $request){

         $whereClauses=[];
         if($request->get('nombres')){
            $clause=['nombre','LIKE','%'.$request->get('nombres').'%'];
            array_push($whereClauses,$clause);
         }
         if($request->get('apellidos')){
            $clause=['apellido','LIKE','%'.$request->get('apellidos').'%'];
            array_push($whereClauses,$clause);
         }
         if($request->get('correo')){
            $clause=['correo','=',$request->get('correo')];
            array_push($whereClauses,$clause);
         }
         if($request->get('telefono')){
            $clause=['telefono','=',$request->get('telefono')];
            array_push($whereClauses,$clause);
         }
         if($request->get('id_departamento')){
            $clause=['id_departamento','=',$request->get('id_departamento')];
            array_push($whereClauses,$clause);
         }
         if($request->get('id_municipio')){
            $clause=['id_municipio','=',$request->get('id_municipio')];
            array_push($whereClauses,$clause);
         }


        //validando datos
        $empleados = DB::table('empleados')
        ->leftJoin('catalogos AS catalogoMuni','empleados.id_municipio','=','catalogoMuni.id')
        ->leftJoin('catalogos AS catalogoDepa','catalogoMuni.id_padre','=','catalogoDepa.id')
        ->select('empleados.*','catalogoMuni.valor AS municipio', 'catalogoDepa.valor AS departamento')
        ->where($whereClauses)
        ->get();





        return response()->json([
            'empleados'=>$empleados
        ]);
    }
}
