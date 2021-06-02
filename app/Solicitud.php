<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Solicitud extends Model
{

    protected $table = 'solicitud';

    protected $primaryKey = 'IDSolicitud';

    protected $fillable = array('IDUser', 'IDTipo_Solicitud', 'IDEstado_Solicitud', 'Fecha_Solicitud', 'IDParroquia', 'IDActa', 'Sacramento');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    /*public function actas()
    {
        return $this->belongsToMany('App\Acta', 'solicitud_acta', 'IDSolicitud', 'IDActa')->withPivot('Descripcion');;
    }*/

    public function acta() {
        return $this->hasOne('App\Acta', 'IDActa', 'IDActa');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'IDUser', 'IDUser');
    }

    public function tipo()
    {
        return $this->hasOne('App\Tipo_Solicitud', 'IDTipo_Solicitud', 'IDTipo_Solicitud');
    }

    public function estado()
    {
        return $this->hasOne('App\Estado_Solicitud', 'IDEstado_Solicitud', 'IDEstado_Solicitud');
    }

    public function parroquia()
    {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquia');
    }
}
