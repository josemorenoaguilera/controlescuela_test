<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    //obtenemos lista de alumnos
    public function index()
    {
        $alumnos = Alumno::all()->toArray();
        return array_reverse($alumnos);
    }

    //creamos alumno
    public function add(Request $request)
    {
        try {
            $alumno = new Alumno([
                'nombre'            => $request->nombre,
                'apellidos'         => $request->apellidos,
                'genero'            => $request->genero,
                'fechanacimiento'   => $request->fechanacimiento
            ]);
            $alumno->save();
            return response()->json('Se guardo correctamente.');
        } catch (\Throwable $th) {
            return $th;
            //return response()->json('Hubo un error al guardar.');
        }
    }

    //actualizamos alumno
    public function update(Request $request)
    {
        try {
            Alumno::where('id', $request->id)->update([
                'nombre'          => $request->nombre,
                'apellidos'       => $request->apellidos,
                'genero'          => $request->genero,
                'fechanacimiento' => $request->fechanacimiento
            ]);
            return response()->json('Se guardo correctamente.');
        } catch (\Throwable $th) {
            return response()->json('Hubo un error al guardar.');
        }
    }

    //eliminamos alumno
    public function delete($id)
    {
        try {
            Alumno::where('id', $id)->delete();
            return response()->json('Se elimino correctamente.');
        } catch (\Throwable $th) {
            //return response()->json('Hubo un error al eliminar.');
            return $th;
        }
    }

    public function get($id)
    {
        $alumno = Alumno::find($id);
        return response()->json($alumno);
    }
}
