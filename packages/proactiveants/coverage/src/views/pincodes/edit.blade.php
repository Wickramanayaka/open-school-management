@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Edit User Pin Code
                </div>
                <div class="panel-body">
                    @include('coverage::alert')
                    <div class="row">
                        <div class="col-lg-6">
                        <form method="POST" action="{{route('coverage.pincode.update')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Username</label>
                                    <input type="text" readonly class="form-control" id="name" name="name" placeholder="Username" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="pin_code">PIN</label>
                                    <input type="number" class="form-control" id="pin_code" name="pin_code" placeholder="PIN Code" value="{{$user->pin_code}}">
                                    <p class="help-block">Pin code should be six numbers long.</p>
                                </div>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection