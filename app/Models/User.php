<?php

namespace SISAUGES\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table="usuario";
    protected $primaryKey = "id_usuario";
    protected $fillable = ['username', 'password','cedula_persona','estatus'];
    protected $casts = ['id_rol' => 'integer'];
    protected $guarded = ['id_usuario','id_rol'];
    protected $hidden = ['remember_token'];

    public function muestra()
    {
        return $this->hasMany(Muestra::class,'id_usuario');
    }

    public function rol()
    {
        return $this->belongsTo(RolUsuario::class,'id_rol');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula_persona','cedula');
    }

    public function scopeDescripcionUser($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('username', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeCedulaUser($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeRolUser($query,$search)
    {
        if (strlen(trim($search))>=1) {
            return $query->where('id_rol', $search);
        }
    }

    public function scopeStatusUser($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
    }
    
}
