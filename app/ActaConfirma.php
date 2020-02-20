<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActaConfirma extends Model
{
    protected $table = 'ActaConfirma';

    protected $primaryKey = 'IDConfirma';

    protected $fillable = array( 'LugarConfirma','FechaConfirma','PadrinoCon1', 'PadrinoCon2','IDUbicacionActaCon');

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';



    public function acta()
    {
        return $this->belongsTo('sistemaCuriaDiocesana\Acta');
    }
}
