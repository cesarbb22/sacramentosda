<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaConfirma extends Model
{
    protected $table = 'ActaConfirma';

    protected $primaryKey = 'IDConfirma';

    protected $fillable = array( 'IDParroquiaConfirma','LugarConfirma','FechaConfirma','PadrinoCon1','IDUbicacionActaCon','IDUserRegistra','IDParroquiaRegistra');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function user() {
        return $this->hasOne('App\User', 'IDUser', 'IDUserRegistra');
    }

    public function parroquia() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaConfirma');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
