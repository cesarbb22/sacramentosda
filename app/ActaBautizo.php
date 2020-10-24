<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaBautizo extends Model
{

    protected $table ='ActaBautismo';
    protected $primaryKey = 'IDBautismo';
    protected $fillable = array( 'IDParroquiaBautismo','LugarBautismo','FechaBautismo','PadrinoBau1', 'PadrinoBau2','IDUbicacionActaBau','IDUserRegistra','IDParroquiaRegistra' );
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';


    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function user() {
        return $this->hasOne('App\User', 'IDUser', 'IDUserRegistra');
    }

    public function parroquia()
    {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaBautismo');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
