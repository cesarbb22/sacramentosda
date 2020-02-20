<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{

    protected $table = 'Solicitud';

    protected $primaryKey = 'IDSolicitud';

    protected $fillable = array('IDPersona', 'IDTipo_Solicitud', 'IDEstado_Solicitud');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';

}
