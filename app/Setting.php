<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
* Это модель соответствует таблице settings в БД, в которой хранится Email, на который отправлять уведомления о появлении новых заявок
*/
class Setting extends Model
{
    protected $fillable = ['value'];

}
