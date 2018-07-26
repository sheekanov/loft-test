<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/*
* Этот посредник проверяет доступ текущего пользователя к менеджерской части сайта, и, если доступ отсутствует, перенаправляет на "клиентскую" часть сайта
*/
class ManagerOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == 1) {
            return $next($request);
        } else {
            return redirect()->route('request');
        }
    }
}
