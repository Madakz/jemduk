<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    public function role(){
        return $this->hasMany('App\Role');
    }

    public function user(){
        return $this->hasMany('App\User');
    }
}
