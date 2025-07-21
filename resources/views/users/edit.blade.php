@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">User Info Edit</div>
                <div class="panel-body">
                    @include('partials.alert')
                    <form method="POST" action="{{ route('user.update',$user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="teacher_id" class="control-label">Teacher</label>
                                    <select id="teacher_id" class="form-control select2" name="teacher_id" required>
                                        @foreach ($teachers as $teacher)
                                            @if($teacher->id==$user->teacher->id)
                                                <option selected value="{{$teacher->id}}">{{$teacher->fullName}}</option>
                                            @else
                                                <option value="{{$teacher->id}}">{{$teacher->fullName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="role_id" class="control-label">Role</label>
                                    <select id="role_id[]" class="form-control select2" multiple name="role_id[]" required>
                                        @foreach ($roles as $role)
                                            @if($user->roles->contains('id',$role->id))
                                            <option selected value="{{$role->id}}">{{$role->name}}</option>
                                            @else
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>       
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Change Password
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('user.updatePassword',$user->id) }}">
                        {{ csrf_field() }}
                        {{--<div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Current Password</label>
                                    <input id="current_password" type="password" class="form-control" name="current_password" required autocomplete="off">
                                    @if ($errors->has('current_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">New Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="off">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        $(document).ready(function(){
            $(".select2").select2({
                theme: 'bootstrap'
            });
        })
    </script>
@endsection
