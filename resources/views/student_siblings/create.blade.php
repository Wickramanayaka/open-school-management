@extends('layouts.app')
@section('content')
<form method="POST" action="{{route('student.add_siblin',$student->id)}}">
    {{ csrf_field() }}
    <div class="panel panel-primary">
        <div class="panel-heading">
            Siblins Information for {{$student->fullName}}
        </div>
        <div class="panel-body">
            <table class="table table-compact" id="student-list">
                <thead>
                    <tr>
                        <th></th>
                        <th>Admission Number</th>
                        <th>Name</th>
                        <th>Class Room</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student_list as $student)
                        <tr>
                            <td><input type="checkbox" name="siblin_id[]" id="siblin_id[]" value="{{$student->id}}"></td>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->fullName}}</td>
                            <td>{{$student->present_class_room->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</form>
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    $("#student-list").DataTable({
        "pageLength": 50
    });
});
</script>    
@endsection
    