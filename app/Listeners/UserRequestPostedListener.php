<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserRequestPosted;
use App\Events\UserRequestPostedEvent;
use Illuminate\Support\Facades\Mail;
use App\Setting;

class UserRequestPostedListener implements ShouldQueue
{
    /*
    * Это листенер отвечает за обработку события - появления новой заявки пользователя. В нем мы будет отправлять Email с уведомлением менеджеру.
    */

    public function __construct()
    {
        //
    }

    public function handle(UserRequestPostedEvent $event)
    {
        sleep(5);
        $mail = new UserRequestPosted($event->userRequest);
        $mail->subject('Новая заявка');
        Mail::to(Setting::find(1)->value)->send($mail); //Setting с id = 1 - это email, куда следует отправлять уведомление
    }
}
