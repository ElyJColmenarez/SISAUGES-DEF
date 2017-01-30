<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class TecnicaEstudio extends Model
{
    public $timestamps = false;
    protected $table = 'tecnica_estudio';
    protected $primaryKey = 'id_tecnica_estudio';
    protected $fillable = ['descripcion_tecnica_estudio','status'];
    protected $guarded = ['id_tecnica_estudio'];

    public function muestra()
    {
        return $this->belongsToMany(Muestra::class,
            'muestra_tecnica_estudio',
            'id_tecnica_estudio',
            'id_muestra');
    }
}
