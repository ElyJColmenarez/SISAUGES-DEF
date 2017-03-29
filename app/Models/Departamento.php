<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Departamento extends Model
{
    public $timestamps = false;
    protected  $table = "departamento";
    protected  $primaryKey = "id_departamento";
    protected $fillable = ['descripcion_departamento','id_institucion','status'];
    protected $guarded = ['id_departamento'];


    public function institucion()
    {
        return $this->belongsTo(Institucion::class,'id_institucion','id_departamento');
    }

    public function tutor()
    {
        return $this->hasMany(Tutor::class,'id_tutor','id_departamento');
    }

    public function scopeDescripcionDepartamento($query,$search){

        return $query->where('descripcion_departamento', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusDepartamento($query,$search){

        return $query->where('status', '=', $search);
    }

    public function scopeInstitutoDepartamento($query,$search){

        return $query->where('id_institucion', '=', $search);
    }

    public function scopeInstitucionRelaciones($query,$request){

        return $query->whereExists(function($query) use ($request){
        
            $query->select(DB::raw(1))->from('institucion')->where('nombre_institucion', 'LIKE', '%'.$request->nombre_institucion.'%');

        });

    }

}
