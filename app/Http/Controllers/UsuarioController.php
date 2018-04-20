<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo\Persona;
use Log;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Persona::latest()->paginate(5); //Ordena los resultados por fecha por defecto de Laravel

      //Extrae todos los datos por medio de JSON guardados en una BD e incluye la paginación
      //Paginación: se opera de la siguiente manera:
      // -1 + 1 = 0 --> 0 * 5 = 0  desde ahí se empieza a sumar 1 hasta llegar el límite de Paginación
      // 0 + 1 = 1 --> 1 * 5 = 5
      // 1 + 1 = 2 --> 2 * 5 = 10
      return view('usuario.index', compact(['json'=>'user']))->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('usuario/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       try {
         $user = new Persona([
           'nombre' => $request->input('nombre'),
           'fecha' => $request->input('fecha'),
           'edad' => $request->input('edad'),
         ]);
          $user->save();
          response()->json(['status'=>true, 'Todo está bien'], 200);

          //Llama al método INDEX para volver a la tabla inicio
          return redirect()->action('UsuarioController@index');



       } catch (\Exception $e) {
         Log::critical("No se pudo almacenar {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
         return response('Se ha producido un error en los datos', 500);
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try{
    		$user = Persona::find($id);

        if(!$user){
    			return response()->json(['No existe'], 404);
    		}
    		//response()->json($user, 200);
        return view('usuario/show', compact(['json'=>'user']));

    	} catch (\Exception $e){
    		Log::critical("No se pudo almacenar: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
    		return response('Se ha producido un error en los datos', 500 );
    	}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = Persona::find($id);
      return view('usuario/edit', compact(['json'=>'user']));
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
      try {
        $user = Persona::find($id);

        if(!$user)
        {
          return response()->json(['No existe'], 404);
        }
        $user->update($request-> all());

        response(array(
                'error' => false,
                'message' =>'Alumno Modificado...',
               ),200);
        return redirect()->action('UsuarioController@index');

      } catch (\Exception $e) {
        Log::critical("No se pudo almacenar {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
        return response('Se ha producido un error en los datos', 500);
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
      try {
        $user = Persona::find($id);

        if(!$user)
        {
           return response()->json(['No existe'], 404);
        }else{
          $user->delete();
          response()->json('Usuario borrado', 200);

          //Llama al método INDEX para volver a la tabla inicio
          return redirect()->action('UsuarioController@index');
        }
      } catch (\Exception $e) {
        Log::critical("No se pudo almacenar  {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
        return response('Se ha producido un error en los datos', 500);
      }
    }
}
