<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public $timestamps = false;
    protected $table = "tutor";
    protected $primaryKey = "id_tutor";
    protected $guarded = ['id_tutor','id_departamento','id_persona','id_status'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class,'id_departamento','id_tutor');

    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'id_persona','id_usuario');
    }
}
