<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserRequest;
use Illuminate\Support\Facades\Auth;

/*
* Этот контролллер отвечает за функционал менеджерской части сайта
*/
class ManagerController extends Controller
{
    /*
    * Этот метод просто рендерит страничку со списком заявок
    */
    public function index()
    {
        $userRequests = UserRequest::all();

        return view('manager', [
            'userRequests' => $userRequests,
            'message' => ''
        ]);
    }

    /*
    * Этот метод отвечает за обновление Email, на который будут отправляться извещения о новых заявках
    */
    public function updateEmail(Request $request)
    {
        $userRequests = UserRequest::all();

        $validationRules = array(
            'email' => "required | email",
        );

        $validationMessages = array(
            'email.required' => 'Email должен быть указан',
            'email.email' => 'Некорректный формат Email'
        );

        $validation = Validator::make($request->all(), $validationRules, $validationMessages);

        if ($validation->fails()) {
            $message = $validation->errors()->first();
            return view('manager', [
                'userRequests' => $userRequests,
                'message' => $message
                ]);
        } else {
            $email = Setting::find(1);
            $email->value = $request->email;
            $email->save();
            return redirect()->route('manager');
        }
    }

    /*
    * Этот метод отвечает за пометку заявок как прочитанных
    */
    public function processRequests(Request $request)
    {
        $processedIds = $request->except('_token');

        foreach ($processedIds as $processedId)
        {
            $processerRequest = UserRequest::find($processedId);
            $processerRequest->isProcessed = 1;
            $processerRequest->save();
        }

        return redirect()->route('manager');
    }
}
