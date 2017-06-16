<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class TecnicaEstudio extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = 'tecnica_estudio';
    protected $primaryKey = 'id_tecnica_estudio';
    protected $fillable = ['descripcion_tecnica_estudio','estatus'];
    protected $guarded = ['id_tecnica_estudio'];

    public function archivo()
    {
        return $this->hasMany(Archivo::class,'id_tecnica_estudio');
    }

    public function scopeDescripcionTecnicaE($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('descripcion_tecnica_estudio', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeStatusTecnicaE($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
}
