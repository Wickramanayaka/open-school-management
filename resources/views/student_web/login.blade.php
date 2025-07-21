@extends('student_web.app')
@section('content')
<div class="container">
<form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('t.post_login') }}">
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
                        <h3><b>Enter your telephone number and pin to login</b></h3>
                        <br>
                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="telephone" placeholder="Telephone Number Eg: 0771231230" type="telephone" class="form-control" name="telephone" required>

                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="otp" placeholder="Pin Eg: 123456" type="number" class="form-control" name="otp" required>

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
                            <button type="submit" class="btn btn-primary btn-block">
                                LOGIN
                            </button>
                        </div>
                    </div>
                    <br><br><br>
            </div>
        </div>
    </div>
</div>
</form>
</div>
@endsection