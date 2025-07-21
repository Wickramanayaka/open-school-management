@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                House
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    @include('partials.alert')
                    <form method="POST" action="{{route('cluster.update',$cluster->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                    <input type="text" class="form-control" id="code" name="code" placeholder="Name" required value="{{$cluster->code}}">
                                        <p class="text-danger"></p>
                                    </div>
                            </div>
                            <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                    <input type="text"  class="form-control" id="name" name="name" placeholder="Start" required value="{{$cluster->name}}">
                                        <p class="text-danger" ></p>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                <textarea  class="form-control" id="description" name="description" placeholder="Description">{{$cluster->description}}</textarea>
                                    <p class="text-danger" ></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
