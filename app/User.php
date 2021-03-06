<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $primaryKey = 'IDUser';

    public $timestamps = true;

    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Nombre', 'PrimerApellido', 'SegundoApellido', 'email', 'IDParroquia', 'NumCelular', 'IDPuesto', 'Activo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getAuthPassword()
    {
        return $this->password;
    }

    public function puesto() {
        return $this->hasOne('App\Puesto', 'IDPuesto', 'IDPuesto');
    }

    public function parroquia() {
        return $this->hasOne('App\Parroquia', 'IDParroquia', 'IDParroquia');
    }


    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token,$this->Nombre));
    }
}
