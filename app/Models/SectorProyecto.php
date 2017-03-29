<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class SectorProyecto extends Model
{
    public $timestamps = false;
    protected $table = 'sector_proyecto';
    protected $primaryKey = 'id_sector_pr';
    protected $fillable = ['descripcion_sector','status'];
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

        return $query->where('status', '=', $search);
    }
}
