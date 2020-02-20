<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'Puesto';

    protected $primaryKey = 'IDPuesto';

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NombrePuesto',
    ];
}
