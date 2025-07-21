@extends('layouts.app')
@section('content')
<div class="container">
<form class="form-horizontal" method="POST" autocomplete="off" action="{{ route('parents.store') }}">
<div class="row">
    <div class="col-md-6" style="margin-top: 50px;">
        <div class="panel panel-default panel-bg card">
            <div class="panel-body">
                <div class="row">
                        <div class="col-lg-10 col-lg-offset-1 text-center">
                        {{ csrf_field() }}
                        <h3><b>Parents app user creation</b></h3>
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
                                Create user account
                            </button>
                        </div>
                    </div>
                    <br><br><br>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="margin-top: 50px;"></div>
</div>
</form>
</div>
@endsection