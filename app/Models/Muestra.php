<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Muestra extends Model implements AuditableContract
{
    use Auditable;

    public $timestamps=false;
    protected $table="muestra";
    protected $primaryKey="id_muestra";
    protected $fillable = [ 'codigo_muestra',
                            'nombre_original_muestra',
                            'descripcion_muestra',
                            'fecha_recepcion',
                            'estatus'];
    protected $guarded = ['id_muestra','id_usuario','id_tipo_muestra'];

    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }

    public function archivo()
    {
        return $this->hasMany(Archivo::class,'id_muestra');
    }

    public function proyecto()
    {
        return $this->belongsToMany(Proyecto::class,'muestra_proyecto','id_muestra','id_proyecto');
    }

    public function tipoMuestra()
    {
        return $this->belongsTo(TipoMuestra::class,'id_tipo_muestra');
    }

    public function scopeCodigoMuestra($query,$search){

        if (strlen(trim($search))>=1) {

            return $query->where('codigo_muestra', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeTipoMuestra($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('id_tipo_muestra', '=', $search);
        }

    }

    public function scopeDescripcionMuestra($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('descripcion_muestra', 'LIKE', '%'.$search.'%');
        }
    }
    
    public function scopeFechaRecepcionMuestra($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('fecha_recepcion', '=', $search);
        }
    } 

    public function scopeStatusMuestra($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', '=', $search);
        }else{
            return $query->where('estatus', '=', 1);
        }
    }
}
