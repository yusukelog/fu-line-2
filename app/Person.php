<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Person extends Model
{
    protected $guarded = array('id');
    public function getData()
    {
        return  $this->name . '（更新日：' . $this->updated_at . '　登録日：' . $this->created_at . '）';
    }

    public static $rules = array(
        'name' => 'required|unique:people,name',
    );
}
