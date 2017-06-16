<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class Laboratorio extends Model implements AuditableContract
{
    use Auditable;
	public $timestamps=false;
    protected $table="laboratorio";
    protected $primaryKey="id_laboratorio";
    protected $fillable = ['nombre_laboratorio','ubicacion_laboratorio','telefono_laboratorio','estatus'];
    protected $guarded = ['id_Laboratorio'];

    public function scopeNombreLaboratorio($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('nombre_laboratorio', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeUbicacionLaboratorio($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('ubicacion_laboratorio', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeTelefonoLaboratorio($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('telefono_laboratorio',  'LIKE', '%'.$search.'%');
        }
    }
    
    public function scopeStatusLaboratorio($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }

}
