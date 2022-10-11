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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($companies as $company)
                                        <tr onclick="location.href = '{{route('company.edit',$company->id)}}'">
                                            <td>{{$company->id}}</td>
                                            <td>{{$company->title}}</td>
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
