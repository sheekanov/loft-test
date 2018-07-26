<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
/*
 * Этот сидер отвечает за добавление менеджера в таблицу Users
 */
    public function run()
    {
        $manager = new User();
        $manager->name = 'Manager';
        $manager->email = 'manager@manager.com';
        $manager->role = 1;
        $manager->password = Hash::make('manager');
        $manager->save();
    }
}
