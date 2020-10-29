<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicacionActa extends Model
{


    protected $table = 'ubicacionacta';

    protected $primaryKey = 'IDUbicacionActa';

    protected $fillable = array('Libro', 'Folio', 'Asiento');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';
}
