<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMuestra extends Model
{
    public $timestamps=false;
    protected $table="tipo_muestra";
    protected $primaryKey="id_tipo_muestra";
    protected $fillable = ['descripcion_tipo_muestra'];
    protected $guarded = ['id_tipo_muestra'];

    public function muestra()
    {
        return $this->hasMany(Muestra::class,'id_tipo_muestra');
    }
}
