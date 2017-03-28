<?php

namespace SISAUGES\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $table="usuario";
    protected $primaryKey = "id_usuario";
    protected $fillable = ['username', 'password','cedula_persona','status'];
    protected $casts = ['id_rol' => 'integer'];
    protected $guarded = ['id_usuario','id_rol'];
    protected $hidden = ['remember_token'];

    public function muestra()
    {
        return $this->hasMany(Muestra::class,'id_muestra');
    }

    public function rol()
    {
        return $this->belongsTo(RolUsuario::class,'id_rol');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula');
    }

    public function scopeDescripcionUser($query,$search)
    {
        return $query->where('username', 'LIKE', '%'.$search.'%');
    }

    public function scopeCedulaUser($query,$search)
    {
        return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusUser($query,$search){

        return $query->where('status', '=', $search);
    }
    
}
