<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Solicitud extends Model
{

    protected $table = 'Solicitud';

    protected $primaryKey = 'IDSolicitud';

    protected $fillable = array('IDUser', 'IDTipo_Solicitud', 'IDEstado_Solicitud');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    public function actas()
    {
        return $this->belongsToMany('sistemaCuriaDiocesana\Acta', 'Solicitud_Acta', 'IDSolicitud', 'IDActa')->withPivot('Descripcion');;
    }

    public function user()
    {
        return $this->hasOne('sistemaCuriaDiocesana\User', 'IDUser', 'IDUser');
    }

    public function tipo()
    {
        return $this->hasOne('sistemaCuriaDiocesana\Tipo_Solicitud', 'IDTipo_Solicitud', 'IDTipo_Solicitud');
    }

    public function estado()
    {
        return $this->hasOne('sistemaCuriaDiocesana\Estado_Solicitud', 'IDEstado_Solicitud', 'IDEstado_Solicitud');
    }
}
