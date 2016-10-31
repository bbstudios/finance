<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function uplevel(){
        return User::find($this->uplevel);
    }

    public function downlevels(){
        return $this->hasMany('App\User','uplevel');
    }

    public function fistdownlevel(){
        return User::find($this->firstdownlevel);
    }

    public function equal(User $user){
        return $this->id==$user->id?true:false;
    }
}
