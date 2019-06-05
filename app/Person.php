<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    protected $guarded = array('id');
    public function getData()
    {
        //return  $this->name .' ' . $this->old . '歳 ' . $this->tall . 'cm ' . 'B' .$this->bust . '(' . $this->cup . ')' .'W' . $this->west . 'H' . $this->hip;
        return  $this->name;
    }

    public static $rules = array(
        'name' => 'required|unique:people,name',
    );
}
