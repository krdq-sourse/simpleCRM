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
                            <a href="{{route('company.create')}}"><button style="width: 10%; margin: 5px" type="button" class="btn btn-block btn-primary">{{__('Создать новую запись')}}</button></a>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>{{__('Название компании')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{$company->id}}</td>
                                        <td>{{$company->title}}</td>
                                        <td style="max-width: 20px"><a href="{{route('company.edit',$company->id)}}"
                                                                       class="btn btn-app">
                                                <i class="fas fa-edit"></i>
                                                {{__('Редактировать')}}
                                            </a></td>
                                        <td style="max-width: 20px"><a class="btn btn-app btn-delete"
                                                                       data-action="{{route('company.destroy', $company->id)}}">
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
                                </tr>
                                </tfoot>
                            </table>
                            {{ $companies->links() }}

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
