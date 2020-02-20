<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaDefuncion extends Model
{
    protected $table = 'ActaDefuncion';

    protected $primaryKey = 'IDDefuncion';

    protected $fillable = array('LugarDefuncion','FechaDefuncion','CausaMuerte','IDUbicacionActaDef');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('sistemaCuriaDiocesana\Acta');
    }
}
