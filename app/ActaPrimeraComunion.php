<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaPrimeraComunion extends Model
{
    protected $table = 'actaprimeracomunion';
    protected $primaryKey = 'IDPrimeraComunion';
    protected $fillable = array( 'IDParroquiaPrimeraComunion','LugarPrimeraComunion','FechaPrimeraComunion','NotasMarginales','IDUbicacionPrimeraComunion','NombreUserRegistra','IDParroquiaRegistra', 'AvisoEnviado');
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';

    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function parroquia() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaPrimeraComunion');
    }

    public function ubicacionActa()
    {
        return $this->hasOne('App\UbicacionActa', 'IDUbicacionActa', 'IDUbicacionPrimeraComunion');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
