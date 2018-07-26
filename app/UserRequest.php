<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
* Это модель отвечает за заявки пользователей
*/
class UserRequest extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
