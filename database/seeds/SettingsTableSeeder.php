<?php

use Illuminate\Database\Seeder;

/*
 * Этот сидер отвечает за добавление Email, на который мы будем отправлять уведомления о заявках, в таблицу Settings
 */
class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $email = new \App\Setting();
        $email->name = 'requests_email';
        $email->value = 'sheekanov@gmail.com';
        $email->save();
    }
}
