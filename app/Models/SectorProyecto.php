<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SectorProyecto extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = 'sector_proyecto';
    protected $primaryKey = 'id_sector_pr';
    protected $fillable = ['descripcion_sector','estatus'];
    protected $guarded = ['id_sector_pr'];

    public function proyecto()
    {
        return $this->hasMany(Proyecto::class,'id_sector_pr');
    }

    public function scopeDescripcionSector($query,$search)
    {
        return $query->where('descripcion_sector', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusSector($query,$search){

        return $query->where('estatus', '=', $search);
    }
}
