@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Division
            </div>
            <div class="panel-body">
                    @include('partials.alert')
            <form class="form-inline" method="POST" action="{{route('division.update',$division->id)}}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Division" required value="{{$division->name}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-primary">Clear</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection