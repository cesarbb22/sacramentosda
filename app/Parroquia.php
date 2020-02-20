<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{

    protected $table = 'Parroquia';

    protected $primaryKey = 'IDParroquia';

    protected $fillable = array('NombreParroquia');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    public function acta()
    {
        return $this->belongsToMany('sistemaCuriaDiocesana\Acta', 'IDParroquia', 'IDParroquia');
    }

    public function user() {
        return $this->belongsToMany('sistemaCuriaDiocesana\User', 'IDParroquia', 'IDParroquia');
    }
}
