<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server_credentials extends Model
{
    protected $fillable = [
    	'server_id',
    	'username',
    	'password'
    ];

    protected $hidden = [
    	'server_id',
    	'created_at'
    ];


    public function setUsernameAttribute($username)
    {
    	$this->attributes['username'] = encrypt($username);
    }

    public function setPasswordAttribute($password)
    {
    	$this->attributes['password'] = encrypt($password);
    }

    public function getUsernameAttribute()
    {
    	return decrypt($this->attributes['username']);
    }

    public function getPasswordAttribute()
    {
    	return decrypt($this->attributes['password']);
    }

    public function Server(){
    	return $this->belongsTo('Server');
    }

}
