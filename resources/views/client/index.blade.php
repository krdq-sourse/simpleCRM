@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style="margin-top: 1%" class="card">
                        <div class="card-header">
                            <h3 class="card-title">Компании</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>{{__('Название компании')}}</th>
                                    <th>email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td style="width: 25px"><a href="{{route('client.edit',$user->id)}}"
                                                                       class="btn btn-app">
                                                <i class="fas fa-edit"></i>
                                                {{__('Редактировать')}}
                                            </a></td>
                                        <td style="width: 25px"><a class="btn btn-app btn-delete"
                                                                       data-action="{{route('client.destroy', $user->id)}}">
                                                <i class="fas fa-trash"></i>
                                                {{__('Удалить')}}
                                            </a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>{{__('Название компании')}}</th>
                                    <th>email</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $users->links() }}

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
