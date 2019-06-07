<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    protected $guarded = array('id');
    function getTime(){
        return unserialize($this->time);
    }
    public static $rules = array(
        'name' => 'required|unique:people,name',
    );
}
