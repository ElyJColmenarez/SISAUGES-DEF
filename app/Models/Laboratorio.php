<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Laboratorio extends Model
{
	public $timestamps=false;
    protected $table="laboratorio";
    protected $primaryKey="id_laboratorio";
    protected $fillable = ['nombre_laboratorio','ubicacion_laboratorio','telefono_laboratorio','status'];
    protected $guarded = ['id_Laboratorio'];

   /* public function muestraLaboratorio()
    {
        return $this->belongsToMany(Muestra::class,
            'muestra_laboratorio',
            'id_Laboratorio',
            'id_muestra');
    }
*/
    public function scopeNombreLaboratorio($query,$search){

        return $query->where('nombre_laboratorio', 'LIKE', '%'.$search.'%');
    }

    public function scopeUbicacionLaboratorio($query,$search){

        return $query->where('ubicacion_laboratorio', 'LIKE', '%'.$search.'%');
    }

    public function scopeTelefonoLaboratorio($query,$search){

        return $query->where('telefono_laboratorio',  'LIKE', '%'.$search.'%');
    }
    
    public function scopeStatusLaboratorio($query,$search){

        return $query->where('status', '=', $search);
    }

}
