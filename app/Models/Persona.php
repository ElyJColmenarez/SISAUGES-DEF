<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Persona extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = "persona";
    protected $primaryKey = "id_persona";
    protected $fillable = ['cedula','nombre','apellido','email','telefono','estatus'];
    protected $guarded = ['id_persona'];

    public function usuario()
    {
        return $this->hasOne(User::class,'cedula_persona','cedula');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class,'cedula_persona','cedula');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class,'cedula_persona','cedula');
    }

    public function scopeBuscarPersona($query,$search)
    {
        return $query->where('cedula','LIKE', '%'.$search.'%');
    }

    public function scopeNombrePersona($query,$search)
    {
        return $query->where('nombre', 'LIKE', '%'.$search.'%');
    }

    public function scopeApellidoPersona($query,$search)
    {
        return $query->where('apellido', 'LIKE', '%'.$search.'%');
    
    }

    public function scopeEmailPersona($query,$search)
    {
         return $query->where('email', 'LIKE', '%'.$search.'%');
    }

    public function scopeTelefonoPersona($query,$search)
    {
         return $query->where('telefono', 'LIKE', '%'.$search.'%');
    }

    public function scopeStatusPersona($query,$search){

        return $query->where('estatus', '=', $search);
    }
}
