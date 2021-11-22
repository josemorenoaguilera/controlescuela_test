<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Grado;
use Illuminate\Http\Request;

class GradoController extends Controller
{
    //obtenemos lista
    public function index()
    {
        //$grados = Grado::all()->toArray();
        $grados = Grado::select(
            'grado.id',
            'grado.nombre as gradonombre',
            'profesor.nombre as profenombre',
            'profesor.apellidos'
        )->join(
            'profesor',
            'profesor.id', '=', 'grado.profesorId'
        )->get();
        return $grados;
    }

    //creamos 
    public function add(Request $request)
    {
        try {
            $grado = new Grado([
                'nombre'            => $request->nombre,
                'profesorId'        => $request->profesorId
            ]);
            $grado->save();
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
            Grado::where('id', $request->id)->update([
                'nombre'          => $request->nombre,
                'profesorId'       => $request->profesorId
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
            Grado::where('id', $id)->delete();
            return response()->json('Se elimino correctamente.');
        } catch (\Throwable $th) {
            //return response()->json('Hubo un error al eliminar.');
            return $th;
        }
    }

    public function get($id)
    {
        $grado = Grado::find($id);
        return response()->json($grado);
    }
}
