@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Cluster
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    @include('partials.alert')
                    <form method="POST" action="{{route('cluster.store')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
                                        <p class="text-danger"></p>
                                    </div>
                            </div>
                            <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text"  class="form-control" id="name" name="name" placeholder="Name" required>
                                        <p class="text-danger" ></p>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                    <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea  class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                            <p class="text-danger" ></p>
                                        </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-default">Clear</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-6">

                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="alert-warning"><th>Code</th><th>Name</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clusters as $cluster)
                                        <tr>
                                            <td>{{$cluster->code}}</td>
                                            <td><a href="javascript:void(0)" data-toggle="popover" title="Description" data-placement="left" data-content="{{$cluster->description}}">{{$cluster->name}}</a></td>
                                            <td>
                                                <form action="{{route('cluster.destroy',$cluster->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a class="btn btn-primary" href="{{route('cluster.edit',$cluster->id)}}"><i class="fa fa-edit"></i></a>
                                                    <button type="submit" class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
