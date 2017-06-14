<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMuestra extends Model
{
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
        return $query->where('descripcion_tipo_muestra', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusTipoM($query,$search){

        return $query->where('estatus', '=', $search);
    }
}
