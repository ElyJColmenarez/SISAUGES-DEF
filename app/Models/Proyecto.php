<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    public $timestamps = false;
    protected $table = "proyecto";
    protected $primaryKey = "id_proyecto";
    protected $fillable = ['nombre_proyecto','status_proyecto','permiso_proyecto','fecha_inicio','fecha_final'];
    protected $guarded = ['id_proyecto','id_sector_pr'];

    public function institucion()
    {
        return $this->belongsToMany(Institucion::class,'institucion_proyecto','id_proyecto','id_institucion');
    }

    public function estudiante()
    {
        return $this->hasMany(Estudiante::class,'id_estudiante','id_proyecto');
    }

    public function muestras()
    {
        return $this->belongsToMany(Muestra::class,'muestra_proyecto','id_proyecto','id_muestra');
    }

    public function sector()
    {
        return $this->belongsTo(SectorProyecto::class,'id_sector_pr','id_proyecto');
    }
}
