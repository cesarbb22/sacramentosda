<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laico extends Model
{

    protected $table = 'laico';

    protected $primaryKey = 'IDPersona';

    protected $fillable = array('IDTipo_Hijo', 'NombreMadre', 'NombrePadre', 'LugarNacimiento', 'FechaNacimiento');

    public $incrementing = false;

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    public function persona() {
        return $this->belongsTo('App\Persona', 'IDPersona', 'IDPersona');
    }
}
