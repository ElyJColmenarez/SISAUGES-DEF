<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class RolUsuario extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps=false;
    protected $table='rol_usuario';
    protected $primaryKey='id_rol';
    protected $fillable = ['descripcion_rol','estatus'];
    protected $guarded = ['id_rol'];

    public function usuarios()
    {
        return $this->hasMany(User::class,'id_rol');
    }

    public function scopeDescripcionRol($query,$search)
    {
        return $query->where('descripcion_rol', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusRol($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
}
