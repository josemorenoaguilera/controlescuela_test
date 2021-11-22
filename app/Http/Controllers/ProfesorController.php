<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Profesor;
use Illuminate\Http\Request;


class ProfesorController extends Controller
{
    //
    //obtenemos lista
    public function index()
    {
        $profesores = Profesor::all()->toArray();
        return array_reverse($profesores);
    }

    //creamos 
    public function add(Request $request)
    {
        try {
            $profesor = new Profesor([
                'nombre'            => $request->nombre,
                'apellidos'         => $request->apellidos,
                'genero'            => $request->genero
            ]);
            $profesor->save();
            return response()->json('Se guardo correctamente.');
        } catch (\Throwable $th) {
            return $th;
            //return response()->json('Hubo un error al guardar.');
        }
    }

    //actualizamos 
    public function update(Request $request)
    {
        try {
            Profesor::where('id', $request->id)->update([
                'nombre'          => $request->nombre,
                'apellidos'       => $request->apellidos,
                'genero'          => $request->genero
            ]);
            return response()->json('Se guardo correctamente.');
        } catch (\Throwable $th) {
            return response()->json('Hubo un error al guardar.');
        }
    }

    //eliminamos 
    public function delete($id)
    {
        try {
            Profesor::where('id', $id)->delete();
            return response()->json('Se elimino correctamente.');
        } catch (\Throwable $th) {
            //return response()->json('Hubo un error al eliminar.');
            return $th;
        }
    }

    public function get($id)
    {
        $profesor = Profesor::find($id);
        return response()->json($profesor);
    }
}
