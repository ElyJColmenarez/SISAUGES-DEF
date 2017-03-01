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
        return $this->belongsTo(Proyecto::class,'id_proyecto','id_estudiante');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula','id_estudiante');
    }
}
