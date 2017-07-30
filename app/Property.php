<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

	protected $fillable = [
       'property_type',
    ];

    public function landlord(){
        return $this->belongsTo('App\Landlord');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->hasMany('App\Photo');
    }
}
