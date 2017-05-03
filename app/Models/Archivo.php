<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    public $timestamps = false;
    protected $table = "archivo";
    protected $primaryKey = "id_archivo";
    protected $fillable = ['ruta_img_muestra','fecha_analisis','nombre_original_muestra','nombre_temporal_muestra'];
    protected $guarded = ['id_archivo'];

    public function muestra()
    {
        return $this->belongsTo(Muestra::class,'id_muestra');
    }
}
