@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="container-fluid">
                <div class="jumbotron">
                    <h1>Dependancy check</h1>
                    <p>{{$message}}</p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
