<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaDefuncion extends Model
{
    protected $table = 'actadefuncion';

    protected $primaryKey = 'IDDefuncion';

    protected $fillable = array( 'IDParroquiaDefuncion','LugarDefuncion','FechaDefuncion','CausaMuerte','NotasMarginales','IDUbicacionActaDef','NombreUserRegistra','IDParroquiaRegistra', 'AvisoEnviado');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function parroquia() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaDefuncion');
    }

    public function ubicacionActa()
    {
        return $this->hasOne('App\UbicacionActa', 'IDUbicacionActa', 'IDUbicacionActaDef');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
