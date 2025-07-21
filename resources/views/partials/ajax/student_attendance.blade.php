<div class="row" style="margin-top:20px;">
    <div class="col-lg-12">
        <table class="table">
            <tr><th>Admission No.</th><th>Name in Full</th><th>Class</th><th>Number of Attendance</th><th>Presentage %</th></tr>
            @foreach ($students as $student)
                <tr>
                <td>{{$student->admission_number}}</td>
                <td><a href="{{route('student.show',$student->id)}}">{{$student->fullName}}</a></td>
                <td>{{$student->present_class_room->name}}</td>
                <td>{{$student->attendances->where('begin_date','>=',getCurrentAcademicYear()->start)->where('end_date','<=',getCurrentAcademicYear()->end)->sum('attendance')}}</td>
                <td>{{number_format(($student->attendances->where('begin_date','>=',getCurrentAcademicYear()->start)->where('end_date','<=',getCurrentAcademicYear()->end)->sum('attendance')/$total)*100,2)}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>