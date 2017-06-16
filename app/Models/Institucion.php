<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Institucion extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps=false;
    protected $table="institucion";
    protected $primaryKey="id_institucion";
    protected $fillable = ['nombre_institucion','direccion_institucion','correo_institucional','telefono_institucion','estatus'];
    protected $guarded = ['id_institucion'];

    public function proyecto()
    {
        return $this->belongsToMany(Proyecto::class,
            'institucion_proyecto',
            'id_institucion',
            'id_proyecto');
    }

    public function departamento()
    {
        return $this->hasMany(Departamento::class,'id_institucion');
    }

    public function scopeNombreInstitucion($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('nombre_institucion', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeDireccionInstitucion($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('direccion_institucion', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeCorreoInstitucion($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('correo_institucional', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeTelefonoInstitucion($query,$search){
        if (strlen(trim($search))>=1) {
            return $query->where('telefono_institucion', '=', $search);
        }
    }
    
    public function scopeStatusInstitucion($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
}
