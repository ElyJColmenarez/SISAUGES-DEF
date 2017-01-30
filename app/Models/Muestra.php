<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Muestra extends Model
{
    public $timestamps=false;
    protected $table="muestra";
    protected $primaryKey="id_muestra";
    protected $fillable = [ 'codigo_muestra',
        'nombre_original_muestra',
        'tipo_muestra',
        'descripcion_muestra',
        'fecha_recepcion',
        'status'];
    protected $guarded = ['id_muestra','id_usuario'];

    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario','id_muestra');
    }

    public function proyecto()
    {
        return $this->belongsToMany(Proyecto::class,'muestra_proyecto','id_muestra','id_proyecto');
    }

    public function tecnicaEstudio()
    {
        return $this->belongsToMany(TecnicaEstudio::class,
            'muestra_tecnica_estudio',
            'id_muestra',
            'id_tecnica_estudio');
    }
}
