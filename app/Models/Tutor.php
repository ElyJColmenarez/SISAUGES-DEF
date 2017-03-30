<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    public $timestamps = false;
    protected $table = "tutor";
    protected $primaryKey = "id_tutor";
    protected $fillable = ['cedula_persona'];
    protected $guarded = ['id_tutor','id_departamento'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class,'id_departamento');

    }

    public function persona()
    {
        return $this->belongsTo(Persona::class,'cedula_persona','cedula');
    }

    public function scopeCedulaTutor($query,$search){

        return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
    }
}
