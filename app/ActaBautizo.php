<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaBautizo extends Model
{

    protected $table ='ActaBautismo';
    protected $primaryKey = 'IDBautismo';
    protected $fillable = array( 'LugarBautismo','FechaBautismo','PadrinoBau1', 'PadrinoBau2','IDUbicacionActaBau' );
    public $timestamps = true;
    protected $dateFormat = 'Y-m-d H:i:s';


    public function acta()
    {
        return $this->belongsTo('sistemaCuriaDiocesana\Acta');
    }
}
