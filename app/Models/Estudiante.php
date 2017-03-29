<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    public $timestamps=false;
    protected $table="estudiante";
    protected $primaryKey="id_estudiante";
    protected $fillable=['carrera_estudiante', 'semestre_estudiante','cedula_persona'];
    protected $guarded=['id_persona','id_estudiante', 'id_proyecto'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,'id_proyecto');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula');
    }

    public function scopeCarreraEstudiante($query,$search){

        return $query->where('carrera_estudiante', 'LIKE', '%'.$search.'%');
    }

    public function scopeSemestreEstudiante($query,$search){

         return $query->where('semestre_estudiante', 'LIKE', '%'.$search.'%');
    }

    public function scopeCedulaEstudiante($query,$search){

        return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
    }
}
