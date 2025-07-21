@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Teacher Attendance List
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr class="warning"><th>ID Number</th><th>Name in Full</th><th>Class</th><th>Number of Attendance</th><th>Presentage %</th></tr>
                    @foreach ($teachers as $teacher)
                        <tr>
                        <td>{{$teacher->id_number}}</td>
                        <td><a href="{{route('teacher.show',$teacher->id)}}">{{$teacher->fullName}}</a></td>
                        <td>{{$teacher->present_class_room->name}}</td>
                        <td>{{$teacher->attendances->where('begin_date','>=',getCurrentAcademicYear()->start)->where('end_date','<=',getCurrentAcademicYear()->end)->sum('attendance')}}</td>
                        <td>{{number_format(($teacher->attendances->where('begin_date','>=',getCurrentAcademicYear()->start)->where('end_date','<=',getCurrentAcademicYear()->end)->sum('attendance')/$total)*100,2)}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<a href="{{route('teacherAttendance.bulk')}}" class="float"><i class="fa fa-upload btn-float"></i></a>    
@endsection


