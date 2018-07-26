<?php

namespace App\Http\Controllers;

use App\Events\UserRequestPostedEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\UserRequest;
use Illuminate\Support\Facades\Auth;

/*
* Этот контроллер отвечает за функционал создания заявок клиентами
*/
class UserRequestController extends Controller
{
    /*
    * Этот метод просто рендерит страничку с формой обратной связи
    */
    public function index()
    {
        $user = Auth::user();
        $latestUserRequest = $user->userRequests()->orderBy('created_at','desc')->first();
        return view('request', ['success' => 1, 'latestUserRequest' => $latestUserRequest]);
    }

    /*
    * Этот метод отвечает за публикацию заявки пользователем и отправку уведомления менеджеру
    */
    public function store(Request $request)
    {
        $success = 1;
        $message = '';

        $user = Auth::user();
        $latestUserRequest = $user->userRequests()->orderBy('created_at','desc')->first();
        $currentTime = Carbon::now();

        $userRequest = new UserRequest();
        $userRequest->title = $request->title;
        $userRequest->text = $request->text;

        $validationRules = array(
            'title' => 'required',
            'text' => 'required',
        );

        $validationMessages = array(
            'title.required' => 'Тема должна быть заполнена',
            'text.required' => 'Заявка должна содержать текст сообщения'
        );

        $validation = Validator::make($request->all(), $validationRules, $validationMessages);

        if(!is_null($latestUserRequest) && $currentTime->diffInHours($latestUserRequest->created_at) < 24) {
            $success = 0;
            $message = 'Заявки могут отправляться не чаще одного раза в сутки';
        }

        if ($validation->fails()){
            $success = 0;
            $message = $validation->errors()->first();
        }

        if ($success) {
            $message = 'Ваша заявка успешно отправлена';
            $userRequest->title = htmlspecialchars(strip_tags($request->title), ENT_QUOTES);
            $userRequest->text = htmlspecialchars(strip_tags($request->text), ENT_QUOTES);
            $user->userRequests()->save($userRequest);

            event(new UserRequestPostedEvent($userRequest));

            return view('request', [
                'success' => $success,
                'message' => $message,
                'latestUserRequest' => $userRequest
            ]);
        } else {
            return view('request', [
                'success' => $success,
                'message' => $message,
                'userRequest' => $userRequest,
                'latestUserRequest' => $latestUserRequest
                ]);
        }



    }
}
