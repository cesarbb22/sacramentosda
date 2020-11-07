<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaBautizo extends Model
{

    protected $table ='actabautismo';
    protected $primaryKey = 'IDBautismo';
    protected $fillable = array( 'IDParroquiaBautismo','LugarBautismo','FechaBautismo', 'AbuelosPaternos', 'AbuelosMaternos','PadrinoBau1', 'PadrinoBau2', 'SacerdoteBautiza','NotasMarginales','IDUbicacionActaBau','NombreUserRegistra','IDParroquiaRegistra' );
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';


    public function acta()
    {
        return $this->belongsTo('App\Acta');
    }

    public function parroquia()
    {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaBautismo');
    }

    public function parroquiaRegistra() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquiaRegistra');
    }
}
