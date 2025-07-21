@extends('student_web.app')
@section('content')
@if (!isset($valid_telephone))
    Unauthorized Access.
@else
<div class="container">
    <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('t.login') }}">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
            <div class="panel panel-default panel-bg card">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-lg-offset-0 text-center">
                            <img src="{{url('images/logo.png')}}" style="width:60px; margin-bottom:20px;" />
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 text-center">
                            {{ csrf_field() }}
                            <h3 class="text-danger"><b>Enter your OTP to login.</b></h3>
                            <br>
                            <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <input id="otp" placeholder="OTP" type="otp" class="form-control" name="otp" required>
    
                                    @if ($errors->has('otp'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('otp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <input type="hidden" name="telephone" value="{{$valid_telephone}}">
                                <button type="submit" class="btn btn-primary btn-block btn-danger">
                                    Enter your OTP to login
                                </button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 text-center">
                                <p><a href="{{route('t')}}">Try again with new OTP.</a></p>
                            </div>
                        </div>
                        <br><br><br>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>
@endif
@endsection