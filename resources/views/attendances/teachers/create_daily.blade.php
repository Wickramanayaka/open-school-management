@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('teacherAttendance.postDaily')}}">
    {{ csrf_field() }}    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Teacher Attendance Daily
        </div>
        <div class="panel-body">
            @include('partials.alert')
            <div class="form-group">
                <div class="checkbox">
                    <label>
                    <input type="checkbox" checked id="master" onclick="check()">Check All
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>NAME</th><th>ID</th><th>NIC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox" name="teacher[]" checked value={{$teacher->id}}>{{$teacher->fullName}}
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$teacher->admission_number}} 
                                    </td>
                                    <td>
                                        {{$teacher->id_number}}
                                    </td>
                                </tr>                       
                            @endforeach
                        </tbody>
                </table>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="reset" class="btn btn-default">Clear</button>
                    </div>
            </div>
        </div>
    </div>
</form>   
@endsection
@section('javascript')
<script>
    // Select all toggle
    function check(){
        $("input").prop('checked',$("#master").prop('checked'));
    }
    $('.datatable').dataTable({
        paging: false
    });
</script>
@endsection