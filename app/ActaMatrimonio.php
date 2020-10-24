<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaMatrimonio extends Model
{
    protected $table = 'ActaMatrimonio';
    protected $primaryKey = 'IDMatrimonio';
    protected $fillable = array( 'IDParroquiaMatrimonio','LugarMatrimonio','FechaMatrimonio','NombreConyugue','IDUbicacionActaMat','IDUserRegistra','IDParroquiaRegistra');
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
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaMatrimonio');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
