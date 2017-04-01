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
        return $query->where('modulo', 'LIKE', '%'.$search.'%');
    }

    public function scopeOperacionAuditoria($query,$search)
    {
        return $query->where('operacion', 'LIKE', '%'.$search.'%');
    }

    public function scopeDescripcionAuditoria($query,$search)
    {
        return $query->where('descripcion','LIKE', '%'.$search.'%');
    }

    public function scopeUsiarioAuditoria($query,$search)
    {
        return $query->where('usuario','LIKE', '%'.$search.'%');
    }

    public function scopeFechaAuditoria($query,$search){

        return $query->where('fecha', 'LIKE', '%'.$search.'%');
    }

}

