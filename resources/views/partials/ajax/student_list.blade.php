@if (count($students) > 0)
<table class="table table-compact" id="data-table">
    <thead>
        <tr>
            <th>&nbsp;</th><th>Admission No.</th><th>Full Name</th><th>Class Room</th><th>Address</th><th>Date of Birth</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>
                        <a href="{{route('student.show',$student->id)}}"><img class="img-circle img-responsive" style="width:35px;" src="{{url('images/profiles/students/') ."/" . $student->photo}}" /></a>
                </td>
            <td>{{$student->admission_number}}</td><td><a href="{{route('student.show',$student->id)}}">{{$student->fullName}}</a></td><td>{{$student->present_class_room->name}}</td><td>{{$student->address->address}}</td>
            <td>{{$student->date_of_birth}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<p>Number of Student: {{count($students)}}</p> 
@else
<div class="alert alert-danger">
    No student found...
</div>
@endif
