@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Academic Year</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                    @include('partials.alert')
                    <form method="POST" action="{{route('academicYear.store')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        <p class="text-danger"></p>
                                    </div>
                            </div>
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="start">Start</label>
                                        <input type="text"  class="form-control" id="start" name="start" placeholder="Start" required value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                        <p class="text-danger" ></p>
                                    </div>
                            </div>
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="end">End</label>
                                        <input type="text"  class="form-control" id="end" name="end" placeholder="End" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
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
                                <table class="table table-compact">
                                    <thead>
                                        <tr class="alert-warning"><th>Name</th><th>Start Date</th><th>End Date</th><th></th><th></th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($academic_years as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->start}}</td>
                                            <td>{{$item->end}}</td>
                                            <td>
                                                <form action="{{route('academicYear.destroy',$item->id)}}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <a class="btn btn-primary" href="{{route('academicYear.edit',$item->id)}}"><i class="fa fa-edit"></i></a>
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
@section('javascript')
<script>
    $("#start").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#end").datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>    
@endsection