<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Proyecto extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = "proyecto";
    protected $primaryKey = "id_proyecto";
    protected $fillable = ['nombre_proyecto','estatus_proyecto','permiso_proyecto','fecha_inicio','fecha_final'];
    protected $guarded = ['id_proyecto','id_sector_pr'];

    public function institucion()
    {
        return $this->belongsToMany(Institucion::class,'institucion_proyecto','id_proyecto','id_institucion');
    }

    public function estudiante()
    {
        return $this->hasMany(Estudiante::class,'id_proyecto');
    }

    public function muestras()
    {
        return $this->belongsToMany(Muestra::class,'muestra_proyecto','id_proyecto','id_muestra');
    }

    public function sector()
    {
        return $this->belongsTo(SectorProyecto::class,'id_sector_pr');
    }

    public function scopeNombreProyecto($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('nombre_proyecto', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopePermisoProyecto($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('permiso_proyecto','=',$search);
        }
    }

    public function scopeFechaInicioProyecto($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('fecha_inicio','=',$search);
        }
    }

    public function scopeFechaFinalProyecto($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('fecha_final','=',$search);
        }
    }

    public function scopeStatusProyecto($query,$search){


        if (strlen(trim($search))>=1) {
            return $query->where('estatus_proyecto', $search);
        }else{
            return $query->where('estatus_proyecto','<>','Culminado');
        }

    }

}

