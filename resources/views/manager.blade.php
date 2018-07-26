@extends('layouts.app')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <h1>Заявки пользователей</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <form action="{{route('manager.updateEmail')}}" method="POST">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col-lg-8">
                        <label for="">Введите Email для отправки писем о новых заявках</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{\App\Setting::find(1)->value}}">
                    </div>
                    <div class="col-lg-4">
                        <input type="submit" class="btn btn-primary" value="Сохранить">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12" style="color: red; min-height: 1.5em;">
            {{$message}}
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Новые</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Просмотренные</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <form action="{{route('manager.processRequests')}}" method="POST">
                        {{csrf_field()}}
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                Чтобы отметить заявки как просмотренные, выберите чекбоксы в таблице и нажмите кнопку "Отметить"
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-2">
                                <input type="submit" class="btn btn-primary" value="Отметить">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table style="width: 100%; table-layout: fixed;" class="table table-hover table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%;"></th>
                                            <th style="width: 7%;">Номер</th>
                                            <th style="width: 15%;">Время создания</th>
                                            <th style="width: 15%;">Имя клиента</th>
                                            <th style="width: 20%;">Почта клиента</th>
                                            <th style="width: 15%;">Тема</th>
                                            <th>Сообщение</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userRequests->where('isProcessed', 0) as $newRequest)
                                        <tr id="{{$newRequest->id}}">
                                            <td style="text-align: center;"> <input type="checkbox" value="{{$newRequest->id}}" name="{{$newRequest->id}}" id="check-{{$newRequest->id}}"></td>
                                            <td>{{$newRequest->id}}</td>
                                            <td>{{$newRequest->created_at->format('d.m.Y H:i:s')}}</td>
                                            <td>{{$newRequest->user->name}}</td>
                                            <td>{{$newRequest->user->email}}</td>
                                            <td><div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="">{{$newRequest->title}}</div></td>
                                            <td><div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="">{{$newRequest->text}}</div></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <table style="width: 100%; table-layout: fixed;" class="table table-hover table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 7%">Номер</th>
                                    <th style="width: 15%">Время создания</th>
                                    <th style="width: 15%">Имя клиента</th>
                                    <th style="width: 20%">Почта клиента</th>
                                    <th style="width: 20%">Тема</th>
                                    <th>Сообщение</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userRequests->where('isProcessed', 1) as $processedRequest)
                                    <tr id="{{$processedRequest->id}}">
                                        <td>{{$processedRequest->id}}</td>
                                        <td>{{$processedRequest->created_at->format('d.m.Y H:i:s')}}</td>
                                        <td>{{$processedRequest->user->name}}</td>
                                        <td>{{$processedRequest->user->email}}</td>
                                        <td><div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="">{{$processedRequest->title}}</div></td>
                                        <td><div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" class="">{{$processedRequest->text}}</div></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection