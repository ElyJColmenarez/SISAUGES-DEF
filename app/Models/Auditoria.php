<?php

namespace SISAUGES\Models;

use OwenIt\Auditing\Models\Audit;

class Auditoria extends Audit
{

    public function scopeEventoAuditoria($query,$search)
    {
        return $query->where('event', 'LIKE', '%'.$search.'%');
    }

    public function scopeModuloAuditoria($query,$search)
    {
        return $query->where('auditable_type', 'LIKE', '%'.$search.'%');
    }

    public function scopeOldValuesAuditoria($query,$search)
    {
        return $query->where('old_values','LIKE', '%'.$search.'%');
    }

    public function scopeNewValuesAuditoria($query,$search)
    {
        return $query->where('new_values','LIKE', '%'.$search.'%');
    }

    public function scopeFechaAuditoria($query,$search){

        return $query->where('created_at', 'LIKE', '%'.$search.'%');
    }

}

