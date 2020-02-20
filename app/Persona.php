<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Persona';

    protected $primaryKey = 'IDPersona';

    protected $fillable = array('Cedula', 'Nombre', 'PrimerApellido', 'SegundoApellido');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';




    public function laico() {
        return $this->hasOne('App\Laico', 'IDPersona', 'IDPersona'); // this matches the Eloquent model
    }

    public function acta()
    {
        return $this->belongsTo('App\Acta', 'IDPersona', 'IDPersona');
    }
}
