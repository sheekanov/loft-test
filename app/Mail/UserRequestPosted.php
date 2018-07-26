<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/*
* Этот класс предназначен для подготовки почтового сообщения, которое мы будем отправлять при поступлении новой заявки
*/
class UserRequestPosted extends Mailable
{
    use Queueable, SerializesModels;

    protected $userRequest;

    public function __construct($userRequest)
    {
        $this->userRequest = $userRequest;
    }

    public function build()
    {
        return $this->view('mail.UserRequestPosted', ['userRequest' => $this->userRequest]);
    }
}
