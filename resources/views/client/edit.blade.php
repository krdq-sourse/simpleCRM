@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div style="margin-top: 1%" class="col-12">
                    <div id='errorAlert' class="hidden alert alert-danger alert-dismissible">
                        <button type="button" class="close" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i>{{__('Что-то пошло не так')}}</h5>
                        Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my
                        entire
                        soul, like these sweet mornings of spring which I enjoy with my whole heart.
                    </div>

                    <div id='successAlert' class="hidden alert alert-success alert-dismissible">
                        <button type="button" class="close" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> {{__('Клиент успешно изменен')}}</h5>
                        Success alert preview. This alert is dismissable.
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Изменение данных клиента')}}</h3>
                        </div>
                        <form id='userFromEdit' action="{{route('client.update', $user->id)}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Имя')}}</label>
                                    <input name="name" type="text" value="{{$user->name}}" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="{{__('Имя')}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('email')}}</label>
                                    <input name="email" value="{{$user->email}}" type="email" class="form-control"
                                           id="exampleInputEmail1"
                                           placeholder="{{__('email')}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{__('Изменить')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
