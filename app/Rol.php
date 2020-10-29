<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{

    protected $table = 'rol';

    protected $primaryKey = 'IDRol';

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NombreRol',
    ];
}
