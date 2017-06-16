<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Estudiante extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps=false;
    protected $table="estudiante";
    protected $primaryKey="id_estudiante";
    protected $fillable=['carrera_estudiante', 'semestre_estudiante','cedula_persona','estatus'];
    protected $guarded=['id_persona','id_estudiante', 'id_proyecto'];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,'id_proyecto');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula_persona','cedula');
    }

    public function scopeCarreraEstudiante($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('carrera_estudiante', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeSemestreEstudiante($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('semestre_estudiante', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeCedulaEstudiante($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeStatusEstudiante($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
}
