@extends('layouts.login')

@section('content')
<div class="container">
        <form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('login') }}">
    <div class="row">
        <div class="col-md-12">
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
                    
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <input id="email" placeholder="E-Mail Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                    
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
                    
                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                    
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-lg-10 col-lg-offset-1">
                                        <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Login
                                </button>

                            </div>
                        </div>
                    
                        <div class="row text-center">
                                <div class="col-lg-6 col-lg-offset-3"></div>
                                    <a class="btn btn-link" style="color:#FFF; font-size:8pt; margin-top:20px;" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection
