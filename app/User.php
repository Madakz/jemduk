<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sentinel;

class User extends \Cartalyst\Sentinel\Users\EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'picture' ,'first_name', 'last_name', 'email', 'password', 'phone_number','agent_number','address','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->hasOne('App\Role');
    }

    public function landlord(){
        return $this->hasMany('App\Landlord');
    }

    public function property(){
        return $this->hasMany('App\Property');
    }
}
