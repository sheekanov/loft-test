<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * Этот контроллер отвечает за поведение домашней страничку сайта ("/")
 */

class HomeController extends Controller
{
    /*
    * Этот метод отвечает за перенаправление запроса на страничку для клиента или менеджера
    */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 1) {
            return redirect()->route('manager');
        } else {
            return redirect()->route('request');
        }
    }
}
