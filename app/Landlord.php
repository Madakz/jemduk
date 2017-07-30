<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    public function property(){
        return $this->hasMany('App\Property');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
