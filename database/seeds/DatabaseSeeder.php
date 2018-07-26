<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        //добавление email для оповещения о заявках в таблицу Settings
        $this->call(SettingsTableSeeder::class);

        //добавление менеджера в таблицу Users
        $this->call(UserTableSeeder::class);
    }
}
