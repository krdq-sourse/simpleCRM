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
                                    <th>Название компании</th>
                                    <th>Количество клиентов</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Microsoft</td>
                                    <td>30</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Название компании</th>
                                    <th>Количество клиентов</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Название компании</th>
                                    <th>Количество клиентов</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Microsoft</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Apple</td>
                                    <td>40</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Название компании</th>
                                    <th>Количество клиентов</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
