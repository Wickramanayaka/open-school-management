@extends('layouts.login')

@section('content')
<div class="container">
    <form class="form-horizontal" method="POST" action="{{ route('otp') }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-bg card" style="height:250px;">
                <div class="panel-body">

                    <div class="row">
                        <div class="col-lg-12 col-lg-offset-0 text-center">
                            <img src="{{url('images/logo.png')}}" style="width:60px; margin-bottom:20px;" />
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 text-center">
                                    
                                            {{ csrf_field() }}
                    
                                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required placeholder="Telephone">
                        
                                                        @if ($errors->has('telephone'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('telephone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                        
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">
                                                            Send Me OTP
                                                        </button>
                                                    </div>
                                                </div>

                                                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                            </div>
                        </div>
                        
                        
                </div>
            </div>
        </div>
    </div>
</form>
</div>
@endsection


