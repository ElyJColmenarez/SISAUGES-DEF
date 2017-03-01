<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $table = "persona";
    protected $primaryKey = "id_persona";
    protected $fillable = ['cedula','nombre','apellido','email','telefono','status','tipo_persona'];
    protected $guarded = ['id_persona','tipo_persona'];

    public function usuario()
    {
        return $this->hasOne(User::class,'id_usuario','cedula');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class,'id_estudiante','cedula');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class,'id_tutor','cedula');
    }
}
