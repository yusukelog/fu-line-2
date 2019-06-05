<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = array('id');
    public function getData()
    {
        return $this->id . '： '. $this->name . '（更新日：' . $this->updated_at . '　登録日：' . $this->created_at . '）';
    }
}
