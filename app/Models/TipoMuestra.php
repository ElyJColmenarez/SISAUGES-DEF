<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class TipoMuestra extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = 'tipo_muestra';
    protected $primaryKey = 'id_tipo_muestra';
    protected $fillable = ['descripcion_tipo_muestra','estatus'];
    protected $guarded = ['id_tipo_muestra'];

    public function muestra()
    {
        return $this->hasMany(Muestra::class,'id_tipo_muestra');
    }

    public function scopeDescripcionTipoM($query,$search)
    {   
        if (strlen(trim($search))>=1) {
            return $query->where('descripcion_tipo_muestra', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeStatusTipoM($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
}
