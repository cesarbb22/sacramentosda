<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntermediaActaMatrimonio extends Model
{
    protected $table = 'intermediaactamatrimonio';

    protected $fillable = ['IDPersona', 'IDMatrimonio'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'IDPersona');
    }

    public function actaMatrimonio()
    {
        return $this->belongsTo(ActaMatrimonio::class, 'IDMatrimonio');
    }
}
