@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-bg card">
                

                <div class="panel-body">

                        <div class="row">
                                <div class="col-lg-12 col-lg-offset-0 text-center">
                                    <img src="{{url('images/logo.png')}}" style="width:60px; margin-bottom:20px;" />
                                </div>
                            </div>

                    <form class="form-horizontal" method="POST" action="{{ route('verify_otp') }}">
                        {{ csrf_field() }}
                        <div class="row">
                                <div class="col-lg-10 col-lg-offset-1 text-center">
                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ $telephone or old('telephone') }}" required autofocus placeholder="Telephone">

                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="otp" type="text" class="form-control" name="otp" value="{{ $otp or old('otp') }}" required autofocus placeholder="OTP">

                                @if ($errors->has('otp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('otp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
