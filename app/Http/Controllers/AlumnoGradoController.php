<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AlumnoGrado;
use Illuminate\Http\Request;

class AlumnoGradoController extends Controller
{
    //obtenemos lista
    public function index()
    {
        //$grados = Grado::all()->toArray();
        $alumnogrado = AlumnoGrado::select(
            'alumno_grado.id',
            'alumno_grado.alumnoId',
            'alumno_grado.gradoId',
            'alumno_grado.seccion',
            'alumno.nombre as nombrealumno',
            'alumno.apellidos as apellidosalumno',
            'profesor.nombre as nombreprofe',
            'profesor.apellidos as apellidosprofe',
            'grado.nombre as nombregrado'
        )->join(
            'alumno',
            'alumno_grado.alumnoId', '=', 'alumno.id'
        )->join(
            'grado',
            'alumno_grado.gradoId', '=', 'grado.id'
        )->join(
            'profesor',
            'grado.profesorId', '=', 'profesor.id'
        )
        ->get();
        return $alumnogrado;
    }

    //creamos 
    public function add(Request $request)
    {
        try {
            $grado = new AlumnoGrado([
                'alumnoId'  => $request->alumnoId,
                'gradoId'   => $request->gradoId,
                'seccion'   => $request->seccion
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
            AlumnoGrado::where('id', $request->id)->update([
                'alumnoId'  => $request->alumnoId,
                'gradoId'   => $request->gradoId,
                'seccion'   => $request->seccion
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
            AlumnoGrado::where('id', $id)->delete();
            return response()->json('Se elimino correctamente.');
        } catch (\Throwable $th) {
            //return response()->json('Hubo un error al eliminar.');
            return $th;
        }
    }

    public function get($id)
    {
        $grado = AlumnoGrado::find($id);
        return response()->json($grado);
    }
}
