<?php

namespace SISAUGES\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Tutor extends Model implements AuditableContract
{
    use Auditable;
    public $timestamps = false;
    protected $table = "tutor";
    protected $primaryKey = "id_tutor";
    protected $fillable = ['cedula_persona','estatus'];
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
        if (strlen(trim($search))>=1) {
            return $query->where('cedula_persona', 'LIKE', '%'.$search.'%');
        }
    }

    public function scopeStatusTutor($query,$search){

        if (strlen(trim($search))>=1) {
            return $query->where('estatus', $search);
        }else{
            return $query->where('estatus', 1);
        }
        
    }
}
