@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Chapter Edit
                </div>
                <div class="panel-body">
                <form class="form-inline" method="POST" action="{{route('chapter.update',$chapter->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                        <div class="form-group">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Number" required value="{{$chapter->number}}">
                        </div>
                        <div class="form-group">
                            <input size="50" type="text" class="form-control" id="name" name="name" placeholder="Chapter Name" required value="{{$chapter->name}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
@endsection