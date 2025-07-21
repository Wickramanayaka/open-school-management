@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('studentAttendance.postBulk')}}" enctype="multipart/form-data">
    {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Student Attendance Bulk Upload
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="row">
                <div class="col-lg-12">
                    <h3>Instructions:</h3>
                    <ul>
                        <li>Click to download template and download the template</li>
                        <li>Unzip the telpmate zip file which conatains all the class rooms in the school</li>
                        <li>Open one class room file (Eg: 5A.csv)</li>
                        <li>Enter begin date of the term (format should be 2018-09-01) under begin</li>
                        <li>Enter end date of the term (format should be 2018-11-30) under end</li>
                        <li>Enter student attendence count (do not put AB for totally absent student use 0)</li>
                        <li>Once the entering complete save the file (Do not change the file extension or columns order)</li>
                        <li>Click on Browse and select the file to upload</li>
                        <li>Click on Upload to upload the attendence for the class room.</li>
                        <li>Attendance upload will not update existing attendence records , it will add additional records. Please keep those in mind.</li>
                    </ul>
                    <div class="form-group">
                        <a href="{{route('studentAttendance.download')}}" class="btn btn-primary">Click to Download Template</a>
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