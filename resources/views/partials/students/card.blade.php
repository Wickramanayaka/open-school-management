@if (count($students)>0)
<div class="row">
    @foreach ($students as $student)
    <div class="col-lg-3">
            <div class="card" style="margin-bottom:30px;">
            <img src="{{url('images/profiles/students/') . '/' . $student->photo}}" style="width: 100%; display:block; margin: 0 auto;">
                <div class="container">
                {{-- <h3>{{$student->nameWithInitials}}<br><small>{{$student->address->fullAddress}}</small></h3> --}}
                <h3>{{$student->first_name}} {{$student->other_name}}<br><small>{{$student->address->fullAddress}}</small></h3>
                <p>Date of Birth : <b> {{$student->date_of_birth}}</b></p>
                    <p>Admission No. : <b> {{$student->admission_number}}</b></p>
                    <p>Present Class : <b> {{$student->present_class_room_id==null? 'Not found': $student->present_class_room->name}}</b></p>
                </div>
                <div class="card-footer">
                <a href="{{route('student.show',$student->id)}}"><b>VIEW PROFILE</b></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
{{$students->appends(['name'=>$name])->links()}} 
@else
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger">
                No student found...
            </div>
        </div>
    </div>
@endif
