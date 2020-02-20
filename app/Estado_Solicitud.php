<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado_Solicitud extends Model
{
    protected $table = 'Estado_Solicitud';

    protected $primaryKey = 'IDEstado_Solicitud';

    protected $fillable = array('NombreEstado_Solicitud');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';
}
