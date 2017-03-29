<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    public $timestamps=false;
    protected $table="institucion";
    protected $primaryKey="id_institucion";
    protected $fillable = ['nombre_institucion','direccion_institucion','correo_institucional','telefono_institucion','status'];
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
        return $this->hasMany(Departamento::class,'id_departamento');
    }

    public function scopeNombreInstitucion($query,$search){

        return $query->where('nombre_institucion', 'LIKE', '%'.$search.'%');
    }

    public function scopeDireccionInstitucion($query,$search){

        return $query->where('direccion_institucion', 'LIKE', '%'.$search.'%');
    }

    public function scopeCorreoInstitucion($query,$search){

        return $query->where('correo_institucional', 'LIKE', '%'.$search.'%');
    }

    public function scopeTelefonoInstitucion($query,$search){

        return $query->where('telefono_institucion', '=', $search);
    }
    
    public function scopeStatusInstitucion($query,$search){

        return $query->where('status', '=', $search);
    }
}
