<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Acta extends Model
{

    protected $table = 'acta';

    protected $primaryKey = 'IDActa';

    protected $fillable = array('IDPersona', 'IDBautismo', 'IDPrimeraComunion', 'IDConfirma', 'IDMatrimonio','IDDefuncion');

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

    public function primeracomunion()
    {
        return $this->hasOne('App\ActaPrimeraComunion', 'IDPrimeraComunion', 'IDPrimeraComunion');
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
        return $this->belongsToMany('App\Solicitud', 'solicitud_acta', 'IDActa', 'IDSolicitud');
    }
}
