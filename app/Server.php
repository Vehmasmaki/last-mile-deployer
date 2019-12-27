<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
    	'name',
    	'perform_updates',
    	'update_path',
    	'ipv4'
    ];

    public function setIpv4Attribute($ip)
    {
    	$this->attributes['ipv4'] = ip2long($ip);
    }

    public function getIpv4Attribute()
    {
    	return long2ip($this->attributes['ipv4']);
    }

    public function Options(){
    	return $this->hasMany('App\Server_option');
    }

    public function Credentials(){
    	return $this->hasMany('App\Server_credentials');
    }

}
