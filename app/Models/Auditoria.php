<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    public $timestamps = false;
    protected $table = "auditoria";
    protected $primaryKey = "id_auditoria";
    protected $fillable = ['modulo','operacion','descripcion','usuario','fecha'];
    protected $guarded = ['id_auditoria'];

   

    public function scopeModuloAuditoria($query,$search)
    {
        return $query->where('nombre', 'LIKE', '%'.$search.'%');
    }

    public function scopePermisoProyecto($query,$search)
    {
        return $query->where('permiso_proyecto','=',$search);
    }

    public function scopeFechaInicioProyecto($query,$search)
    {
        return $query->where('fecha_inicio','=',$search);
    }

    public function scopeFechaFinalProyecto($query,$search)
    {
        return $query->where('fecha_final','=',$search);
    }

    public function scopeStatusProyecto($query,$search){

        return $query->where('status', '=', $search);
    }

}

