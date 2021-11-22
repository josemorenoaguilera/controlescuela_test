<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoGrado extends Model
{
    use HasFactory;
    protected $table = "alumno_grado";
    protected $fillable = [
        'alumnoId',
        'gradoId',
        'seccion'
    ];
}
