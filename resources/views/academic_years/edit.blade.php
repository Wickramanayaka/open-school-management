@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Academic Year</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    @include('partials.alert')
                    <form method="POST" action="{{route('academicYear.update',$academic_year->id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required value="{{$academic_year->name}}">
                                        <p class="text-danger"></p>
                                    </div>
                            </div>
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="start">Start</label>
                                        <input type="text"  class="form-control" id="start" name="start" placeholder="Start" required value="{{$academic_year->start}}">
                                        <p class="text-danger" ></p>
                                    </div>
                            </div>
                            <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="end">End</label>
                                        <input type="text"  class="form-control" id="end" name="end" placeholder="End" value="{{$academic_year->end}}">
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