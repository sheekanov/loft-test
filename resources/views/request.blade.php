@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <h1>Отправьте Вашу заявку</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            Ваша предыдущая заявка: <b>@if(!is_null($latestUserRequest))№{{$latestUserRequest->id}} от {{$latestUserRequest->created_at->format('d.m.Y H:i:s')}}@else отсутствует @endif</b>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12" style="min-height: 1.5em; @if($success == 0)color: red;@endif">
            @if(isset($message)) {{$message}} @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route('request.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Тема</label>
                    <input type="text" class="form-control" id="title" name ="title" placeholder="Тема" value="@if(isset($userRequest)){{$userRequest->title}}@endif">
                </div>
                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea name="text" id="text" placeholder="Текст" rows="10" class="form-control">@if(isset($userRequest)){{$userRequest->text}}@endif</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Отправить">
                </div>
            </form>
        </div>
    </div>
@endsection