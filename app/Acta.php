<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Acta extends Model
{

    protected $table = 'Acta';

    protected $primaryKey = 'IDActa';

    protected $fillable = array('IDPersona', 'IDBautismo', 'IDConfirma', 'IDMatrimonio','IDDefuncion');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function persona()
    {
        return $this->hasOne('App\Persona', 'IDPersona', 'IDPersona');
    }

    public function bautismo()
    {
        return $this->hasOne('App\ActaBautizo', 'IDBautismo', 'IDBautismo');
    }

    public function confirma()
    {
        return $this->hasOne('App\ActaConfirma', 'IDConfirma', 'IDConfirma');
    }

    public function matrimonio()
    {
        return $this->hasOne('App\ActaMatrimonio', 'IDMatrimonio', 'IDMatrimonio');
    }

    public function defuncion()
    {
        return $this->hasOne('App\ActaDefuncion', 'IDDefuncion', 'IDDefuncion');
    }

    public function solicitud()
    {
        return $this->belongsToMany('App\Solicitud', 'Solicitud_Acta', 'IDActa', 'IDSolicitud');
    }
}
