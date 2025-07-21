@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Short Message Result
                </div>
                <div class="panel-body">
                    @include('partials.alert')
                </div>
            </div>
        </div>
        
    </div>
    <a style="margin-bottom:60px;" href="{{url('sms')}}" class="float"><i class="fa fa-plus btn-float"></i></a>    
@endsection
