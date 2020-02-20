<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Solicitud_Acta extends Model
{

    protected $table = 'Solicitud_Acta';

    protected $primaryKey = 'IDSolicitud';

    protected $fillable = array('IDActa', 'Descripcion');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

}
