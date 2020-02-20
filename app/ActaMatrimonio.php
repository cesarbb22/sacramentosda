<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaMatrimonio extends Model
{
    protected $table = 'ActaMatrimonio';
    protected $primaryKey = 'IDMatrimonio';
    protected $fillable = array( 'LugarMatrimonio','FechaMatrimonio','NombreConyugue','IDUbicacionActaMat');
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('sistemaCuriaDiocesana\Acta');
    }
}
