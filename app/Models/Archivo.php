<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Archivo extends Model implements AuditableContract
{
    use Auditable;

    public $timestamps = false;
    protected $table = "archivo";
    protected $primaryKey = "id_archivo";
    protected $fillable = ['ruta_img_muestra','fecha_analisis','nombre_original_muestra','nombre_temporal_muestra'];
    protected $guarded = ['id_archivo','id_tecnica_estudio'];

    public function muestra()
    {
        return $this->belongsTo(Muestra::class,'id_muestra');
    }

    public function tecnicaEstudio()
    {
        return $this->belongsTo(TecnicaEstudio::class,'id_tecnica_estudio');
    }
}
