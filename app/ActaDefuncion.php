<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaDefuncion extends Model
{
    protected $table = 'ActaDefuncion';

    protected $primaryKey = 'IDDefuncion';

    protected $fillable = array('LugarDefuncion','FechaDefuncion','CausaMuerte','IDUbicacionActaDef','IDUserRegistra','IDParroquiaRegistra');

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
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
