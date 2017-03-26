<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $table = "persona";
    protected $primaryKey = "id_persona";
    protected $fillable = ['cedula','nombre','apellido','email','telefono','status'];
    protected $guarded = ['id_persona'];

    public function usuario()
    {
        return $this->hasOne(User::class,'cedula_persona');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class,'cedula_persona');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class,'cedula_persona');
    }

    public function scopeBuscarPersona($query,$search)
    {
        return $query->where('cedula','=',$search);
    }
}
