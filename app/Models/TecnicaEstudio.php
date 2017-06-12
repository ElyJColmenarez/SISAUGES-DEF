<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class TecnicaEstudio extends Model
{
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
        return $query->where('descripcion_tecnica_estudio', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusTecnicaE($query,$search){

        return $query->where('estatus', '=', $search);
    }
}
