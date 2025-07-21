@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Student
                </div>
                <div class="panel-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Grade">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Division">
                        </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword3">Password</label>
                                <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Term">
                            </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Academic Year">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <hr/>
                    @include('partials.ajax.student_attendance')
                </div>
                <div class="panel-footer">
                Click here <a href="{{url('attendance/student/download')}}">download</a> the template to upload attendances.
                    <div class="form-group">
                        <label for="exampleInputFile">File upload</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Teacher
                </div>
                <div class="panel-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Month">
                            </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Term">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Password</label>
                            <input type="text" class="form-control" id="exampleInputPassword3" placeholder="Academic Year">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <hr/>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <table class="table table-stripe">
                                <tr><th>Teacher</th><th>Month</th><th>Attendance</th><th>Absent</th><th>Precentage (%)</th></tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    Click here <a href="{{url('attendance/teacher/download')}}">download</a> the template to upload attendances.
                    <div class="form-group">
                        <label for="exampleInputFile">File upload</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
@endsection