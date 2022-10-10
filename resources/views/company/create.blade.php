@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div style="margin-top: 1%" class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('Создаение компании')}}</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('Название компании')}}</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                           placeholder="{{__('Название компании')}}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{__('Создать')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
