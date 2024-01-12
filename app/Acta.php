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

    public function matrimoniosAsociados()
    {
        // Esta relación devuelve todos los matrimonios asociados con la IDPersona de esta Acta.
        return $this->hasManyThrough(
            'App\ActaMatrimonio',
            'App\IntermediaActaMatrimonio',
            'IDPersona', // Clave foránea en la tabla intermedia que apunta a Acta
            'IDMatrimonio', // Clave foránea en ActaMatrimonio que apunta a la tabla matrimonios
            'IDPersona', // Clave local en Acta que se usa para unirse con la tabla intermedia
            'IDMatrimonio' // Clave local en la tabla intermedia que se usa para unirse con ActaMatrimonio
        );
    }
}
