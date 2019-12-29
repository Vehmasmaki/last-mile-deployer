<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_settings extends Model
{
    protected $fillable = [
    	'setting',
    	'value'
    ];
}
