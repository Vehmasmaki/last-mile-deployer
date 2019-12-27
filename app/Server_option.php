<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server_option extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
    	'option',
    	'value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
    	'server_id',
    	'created_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function Server(){
    	return $this->belongsTo('Server');
    }

}
