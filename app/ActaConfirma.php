<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaConfirma extends Model
{
    protected $table = 'actaconfirma';

    protected $primaryKey = 'IDConfirma';

    protected $fillable = array( 'IDParroquiaConfirma','LugarConfirma','FechaConfirma','PadrinoCon1','NotasMarginales','IDUbicacionActaCon','NombreUserRegistra','IDParroquiaRegistra', 'AvisoEnviado');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function parroquia() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaConfirma');
    }

    public function ubicacionActa()
    {
        return $this->hasOne('App\UbicacionActa', 'IDUbicacionActa', 'IDUbicacionActaCon');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
