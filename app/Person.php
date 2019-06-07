<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'name' => 'required|unique:people,name',
    );
}
