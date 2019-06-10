<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    protected $guarded = array('id');
    function getTime(){
        $time = optional($this->hasOne('App\Time')->first())->time;//optional リレーションで呼び出すときに呼び出し先に値がない場合はNullで返す
        return unserialize($time);
    }
    public static $rules = array(
        'name' => 'required|unique:people,name',
    );
}
