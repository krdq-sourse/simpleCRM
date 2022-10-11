@extends('layouts.app')

@section('content')
    <section class="content">
       <h1>
           {{__('home.about')}}
       </h1>
        <p>
            {{__('home.description')}}
        </p>
        <hr>
        <h1>Ендпоинты Апи</h1>
        <li>
            <a href="https://laravel.com/docs/9.x/controllers#actions-handled-by-resource-controller" target="_blank">Все апи роуты</a> ресурсного контроллера
            <code>company</code> и <code>client</code>. <br>
            Но index был модифицирован, он может принять необязательный GET параметр
            <code>rowsPerPage</code> для включения пагинации, в качесве значения принимает int
        </li>
        <li>
            апи login: POST <code>{{route('api.login')}}</code><br>
            параметры: <br>
         <code>email</code>  - емеил <br>
         <code>password</code>  - пароль
        </li>
        <li>
            регистрация login: POST <code>{{route('api.register')}}</code><br>
            параметры: <br>
            <code>name</code>  - имя <br>
            <code>email</code>  - емеил <br>
            <code>password</code>  - пароль
        </li>
        <li>
            Получить список компаний по <code>id</code> юзера(клиента): GET <code>{{route('get-client-companies')}}</code><br>
            параметры: <br>
            <code>id</code>  - id <br>
        </li>
    </section>
@endsection
