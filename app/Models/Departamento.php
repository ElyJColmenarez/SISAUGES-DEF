<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Departamento extends Model implements AuditableContract
{
    use Auditable;

    public $timestamps = false;
    protected  $table = "departamento";
    protected  $primaryKey = "id_departamento";
    protected $fillable = ['descripcion_departamento','id_institucion','estatus'];
    protected $guarded = ['id_departamento'];


    public function institucion()
    {
        return $this->belongsTo(Institucion::class,'id_institucion');
    }

    public function tutor()
    {
        return $this->hasMany(Tutor::class,'id_tutor','id_departamento');
    }

    public function scopeDescripcionDepartamento($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('descripcion_departamento', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeStatusDepartamento($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
        
    }

    public function scopeInstitutoDepartamento($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('id_institucion', $search);
        }
    }

    public function scopeInstitucionRelaciones($query,$request){

        return $query->whereHas('institucion',function($query) use ($request){
            $query->nombreinstitucion($request->nombre_institucion)->statusinstitucion(1);
        });

    }

}
