@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('teacherAttendance.postBulk')}}" enctype="multipart/form-data">
    {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Teacher Attendance Data Upload
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <a href="{{route('teacherAttendance.download')}}" class="btn btn-primary">Click to Download Template</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="upload_file">Upload File</label>
                        <input type="file" id="upload_file" name="upload_file" required>
                    </div>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
            </div>
        </div>
    </div>
</form>
@endsection